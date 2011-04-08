// espace de nommage UTILS
var RR_UTILS = {};

// Recherche dans un tableau arr, la valeur val
RR_UTILS.inArray  = function(arr, val) {
    for(var i = 0; arr[i] != val && i < arr.length; i++) {}
    return (i < arr.length);
};

// le navigateur est-il est un ipad ?
RR_UTILS.isIpad  = function() {
    return navigator.userAgent.match(/iPad/i);
};

// le navigateur est-il est un iphone ?
RR_UTILS.isIphone  = function() {
    return navigator.userAgent.match(/iPhone/i);
};

// le navigateur est-il est un ipad ou un iphone ?
RR_UTILS.isApple  = function() {
    return RR_UTILS.isIpad() || RR_UTILS.isIphone();
};


// déclenche un copier
RR_UTILS.copier = function (inElement) {
    
    if (inElement.createTextRange) {
        var range = inElement.createTextRange();
        if (range && BodyLoaded==1)
            range.execCommand('Copy');
    } else {
        var flashcopier = 'flashcopier';
        if(!document.getElementById(flashcopier)) {
            var divholder = document.createElement('div');
            divholder.id = flashcopier;
            document.body.appendChild(divholder);
        }
        
        document.getElementById(flashcopier).innerHTML = '';
        var divinfo = '<embed src="./includes/swf/_clipboard.swf" FlashVars="clipboard='+encodeURIComponent(inElement.value)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';
        document.getElementById(flashcopier).innerHTML = divinfo;
    }
    
};
