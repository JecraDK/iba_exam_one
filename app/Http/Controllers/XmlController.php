<?php

namespace App\Http\Controllers;

use App\jobads;
use App\Mail\jobNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Facades\Mail;

class XmlController extends Controller
{

    public function xmlToArray($xml, $options = array()) {
        $defaults = array(
            'namespaceSeparator' => ':',//you may want this to be something other than a colon
            'attributePrefix' => '@',   //to distinguish between attributes and nodes with the same name
            'alwaysArray' => array(),   //array of xml tag names which should always become arrays
            'autoArray' => true,        //only create arrays for tags which appear more than once
            'textContent' => '$',       //key used for the text content of elements
            'autoText' => true,         //skip textContent key if node has no attributes or child nodes
            'keySearch' => false,       //optional search and replace on tag and attribute names
            'keyReplace' => false       //replace values for above search values (as passed to str_replace())
        );
        $options = array_merge($defaults, $options);
        $namespaces = $xml->getDocNamespaces();
        $namespaces[''] = null;

        //get attributes from all namespaces
        $attributesArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
                //replace characters in attribute name
                if ($options['keySearch']) $attributeName =
                    str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
                $attributeKey = $options['attributePrefix']
                    . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                    . $attributeName;
                $attributesArray[$attributeKey] = (string)$attribute;
            }
        }

        //get child nodes from all namespaces
        $tagsArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->children($namespace) as $childXml) {
                //recurse into child nodes
                $childArray = self::xmlToArray($childXml, $options);
                list($childTagName, $childProperties) = each($childArray);

                //replace characters in tag name
                if ($options['keySearch']) $childTagName =
                    str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
                //add namespace prefix, if any
                if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;

                if (!isset($tagsArray[$childTagName])) {
                    //only entry with this key
                    //test if tags of this type should always be arrays, no matter the element count
                    $tagsArray[$childTagName] =
                        in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                            ? array($childProperties) : $childProperties;
                } elseif (
                    is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                    === range(0, count($tagsArray[$childTagName]) - 1)
                ) {
                    //key already exists and is integer indexed array
                    $tagsArray[$childTagName][] = $childProperties;
                } else {
                    //key exists so convert to integer indexed array with previous value in position 0
                    $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
                }
            }
        }

        //get text content of node
        $textContentArray = array();
        $plainText = trim((string)$xml);
        if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;

        //stick it all together
        $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
            ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

        //return node as array
        return array(
            $xml->getName() => $propertiesArray
        );
    }



    public function ContactsFeed(){

        $url = 'http://epico.dk/contacts-feed';
        $xml = XmlParser::load($url);

        $locations = []; //prepare our locations array

        //Access the LocationList -> Location(s) node
        foreach($xml->getContent()->LocationList->Location as $location){
            //Loop through the nodes and convert them to an array, the reason we do ['Location'] is to avoid double array in the return
            $locations[] = self::xmlToArray($location)['Location'];
        }

        //Access the ContactList -> Contact(s) node
        $contactList = [];
        foreach($xml->getContent()->ContactList->Contact as $contact){
            //Loop through the nodes and convert them to an array, the reason we do ['Contact'] is to avoid double array in the return
            $contactList[] = self::xmlToArray($contact)['Contact'];
        }

        return view('contact',['locations' => $locations, 'contactList' => $contactList]);
        // return dd($contactList,$locations);

    }

    public function NewsFeed(){

      $json = Cache::remember('news_feed', 5, function() {
        return json_decode(file_get_contents('http://epico.dk/umbraco/surface/Home/AllNews'));
      });

      $newCollection = [];

      //converting keys to lowercase and creating date objects of the date stamps
      foreach($json as $mainkey => $item){
        foreach($item as $key => $value){

          if(strtolower($key) == 'postdisplaydate'){
            $newCollection[$mainkey][strtolower($key)] = Carbon::createFromTimestamp(str_replace(['/Date(',')/'],['',''],$value)/1000);
          }elseif(strtolower($key) == 'tags') {
            $newCollection[$mainkey][strtolower($key)] = str_replace(',',', ',$value);
          }else {
            $newCollection[$mainkey][strtolower($key)] = $value;
          }
        }
      }

        return view('news',['news' => $newCollection]);

    }

    public function JobsFeed(){

        $json = Cache::remember('job_feed', 5, function() {
          return json_decode(file_get_contents('http://epico.dk/umbraco/surface/Home/AllAdvertising'));
        });

        foreach($json as $feed_job){

          $job = (new jobads());
          if(!$job->where('external_id','=',$feed_job->Id)->first()){

            $job = $job->create([
              'external_id'             => $feed_job->Id,
              'description'             => $feed_job->Description,
              'headline'                => $feed_job->HeadLine,
              'location'                => $feed_job->Location,
              'jobBeginDate'            => $feed_job->JobBeginDate,
              'applicationdeadline'     => $feed_job->Applicationdeadline,
              'duration'                => $feed_job->Duration,
              'country'                 => $feed_job->Country,
              'externalAdIsPublished'   => $feed_job->ExternalAdIsPublished,
              'advertisingType'         => $feed_job->AdvertisingType,
              'searchEmail'             => $feed_job->SearchEmail,
              'footer'                  => isset($feed_job->Footer) ? $feed_job->Footer : ''
            ]);

            $users = User::all();
            foreach($users as $user){
              Mail::to($user->email)->send(new jobNotification($job));
            }

          }
        }


        $jobs = jobads::all()->groupBy('advertisingType');

        return view('jobs.list', compact('jobs'));
        // return dd($news);
    }

    public function getJob(jobads $job){
      return view('jobs.show',compact('job'));
    }
}
