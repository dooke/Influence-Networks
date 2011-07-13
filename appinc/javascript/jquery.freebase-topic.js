/**
 * Depends of jQuery (yes, it's true) and Tipsy
 *
 */
(function(window, $, undefined) {
    
    
    // CROSS-BROWSER JSON SERIALIZATION 
    // FROM http://www.sitepoint.com/javascript-json-serialization/   
    
    // if JSON doesn't exit
    var JSON = window.JSON || {}; 
    
    // add stringify method (if don't exist)
    JSON.stringify = JSON.stringify || function (obj) {
        var t = typeof (obj);
        if (t != "object" || obj === null) {
            // simple data type
            if (t == "string") obj = '"'+obj+'"';
            return String(obj);
        }
        else {
            // recurse array or object
            var n, v, json = [], arr = (obj && obj.constructor == Array);
            for (n in obj) {
                v = obj[n];
                t = typeof(v);
                if (t == "string") v = '"'+v+'"';
                else if (t == "object" && v !== null) v = JSON.stringify(v);
                json.push((arr ? "" : '"' + n + '":') + String(v));
            }
            return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
        }
    };

   
   // EXTEND JQUERY FUNCTION
   $.fn.extend({
      
      // with a new "FreebaseTopic" function
      /**
       * FreebaseTopic function to explore a topic description
       * @function
       * @public
       */
      freebaseTopic : function() {
          
          // this function instance
          var freebaseTopic = this,
              // target
              $this = freebaseTopic,
              // freebase READ url
              freebase_read = "http://www.freebase.com/api/service/mqlread";
              

          // query according the type
          freebaseTopic.typeQuery = {
              // for a person
              "/people/person": [{
                  "name": null,
                  "/people/person/profession" : [],
                  "/people/person/gender" : null,
                  "/people/person/nationality" : [],
                  "/people/person/date_of_birth" : null,
                  "/people/person/place_of_birth" : null,
                  "/people/person/places_lived" : [],
                  "key": [{
                        "namespace": "/wikipedia/en_id",
                        "value":     null,
                        "optional":"optional"
                  }],
                  "/common/topic/image" : [{
                        "id" : null,
                        "optional":"optional"
                  }]
              }],
              // for an organization
              "/organization/organization": [{
                  "name": null,
                  "/organization/organization/headquarters": [],
                  "/organization/organization/legal_structure" : [],
                  "/organization/organization/date_founded" : null,
                  "key": [{
                        "namespace": "/wikipedia/en_id",
                        "value":     null,
                        "optional":"optional"
                 }],
                  "/common/topic/image" : [{
                        "id" : null,
                        "optional":"optional"
                  }]
            }]
          };
          
          
          /**
           * Init function
           * @public
           */
          freebaseTopic.init = function() {
              // live mouse enter event
              $this.live("mouseenter", reachTopic);
              
              // live mouse leave event
              $this.live("mouseleave", leaveTopic);
              
              // tipsy              
              $this.tipsy({
                  gravity: $.fn.tipsy.autoNS,
                  html: true,
                  fade: false,
                  live: true,
                  opacity:1,
                  trigger: "hover",
                  title: getTopicDescription
              });
          
              // open link in a other window
              $this.live("click", function(e) {
                  
                  e.preventDefault();
                                    
                  if( $(this).attr("href") && $(this).attr("href") != "" )
                      window.open($(this).attr("href"));
              });
          };
          
          
          /**
           * Init topic description when mouse enter
           * @private
           */
          function reachTopic() {
              
              var $topic = $(this);
              
              
              // hover class
              $topic.addClass("fb-topic-hover").tipsy("show");
              
              // we already loaded the topic description
              if( $topic.data("description") ) {
                  
                  // show topic description
                  showTopic.call(this);
                  
              // we didn't, we must load it know    
              } else {
                  
                  // load topic from Freebase
                  loadTopic.call(this);
                  
              }
              
          }
          
          
          /**
           * Leave the topic trigger
           * @private
           */
          function leaveTopic() {
              
              // remove hover class
              $(this).removeClass("fb-topic-hover");
          }
          
          /**
           * Load topic's data from Freebase
           * @private
           */
          function loadTopic() {
              
              var $topic = $(this), data;
              
              
              
              // data to import
              data = freebaseTopic.typeQuery[$topic.data("type")];

              // add the id
              data[0].id = $topic.data("mid");

              // freebase query
              data = JSON.stringify( {"query" : data} );

              // freeze description
              $topic.data("description", true);

              // call the api
              $.ajax({
                    // url customized for JSONP callback
                    url: freebase_read+"?callback=?", 
                    // data in a query parameter
                    data: {query:data}, 
                    // context to retrieve the $topic
                    context: $topic,
                    // cross domain json
                    dataType: "jsonp",
                    // when the query is done
                    success :function(data,textStatus, jqXHR) {
                        // if the query is OK
                        if(data.code == "/api/status/ok") {
                            // save the topic's data
                            $topic.data("description", data.result[0]);                            
                            // show the description
                            showTopic.call(this);
                        }
                    }
              });
                  
          }
          
          
          /**
           * Show the topic
           * @private
           */
          function showTopic() {
              
              var $topic = $(this);
              
              // description loaded and mouse on the trigger yet
              if( typeof $topic.data("description") == "object" && $topic.hasClass("fb-topic-hover") )
                    // show tooltips
                    $topic.tipsy("show");
              
          }
          
          
          
          /**
           * Get the description of the topic (HTML)
           * @private
           */
          function getTopicDescription() {
              
              var $topic = $(this);
                            
              if( typeof $topic.data("description") == "object" && $topic.hasClass("fb-topic-hover") ) {
                  
                  var html = "";
                  
                  // for each property
                  $.each( $topic.data("description"), function(key, value) {
                        html += getPropertyDisplay(key, value);
                  });
                  
                  // load wikipedia link
                  if( $topic.data("description").key.length > 0 )
                      $topic.attr("href", "http://en.wikipedia.org/wiki/index.html?curid=" + $topic.data("description").key[0].value)
                  
                  // return the content
                  return html;
              
              // no tooltips yet
              } else return '';
              
          }
          
          /**
           * Get the display of the propertie
           *
           * @private
           * @param string
           * @param mixed
           */
          function getPropertyDisplay(key, value) {                        
             
              // empty value
              if(value == null || value.length == 0 || value == "") return"";
              
              // display according to the key
              switch(key) {
                    
                    // FOR /PEOPLE/PERSON
                    
                    case "/people/person/profession" :
                        return "<p>Profession:&nbsp;" + value.join(", ") + "</p>";
                        break;
                        
                    case "/people/person/gender":
                        return "<p>Gender:&nbsp;" + value + "</p>";
                        break;
                        
                    case "/people/person/nationality":
                        return "<p>Nationality:&nbsp;" + value.join(", ") + "</p>";
                        break;
                        
                    case "/people/person/date_of_birth":
                        return "<p>Date of birth:&nbsp;" + value + "</p>";
                        break;
                        
                    case "/people/person/place_of_birth":
                        return "<p>Place of birth:&nbsp;" + value + "</p>";
                        break;
                        
                    case "/people/person/places_lived":
                        return "<p>Places lived:&nbsp;" + value.join(", ") + "</p>";
                        break;
                        
                    // FOR /ORGANIZATION/ORGANIZATION
                    
                    case "/organization/organization/headquarters":
                        return "<p>Headquarters:&nbsp;" + value.join(", ") + "</p>";
                        break;
                        
                    
                    case "/organization/organization/legal_structure":
                        return "<p>Legal structure:&nbsp;" + value.join(", ") + "</p>";
                        break;
                        
                    
                    case "/organization/organization/date_founded":
                        return "<p>Date founded:&nbsp;" + value + "</p>";
                        break;
                    
                    // FOR ALL
                    
                    case "/common/topic/image":
                        return "<p><img src='http://img.freebase.com/api/trans/image_thumb/" + value[0].id + "?maxheight=120&mode=fit&maxwidth=160' alt='' /></p>";
                        break;
                        
                        
                    default: return ""; break;
              }              
          }
          
          
          // INIT THE CLASS
          freebaseTopic.init();
          
          
      }
      
   });
    
})(window, jQuery);