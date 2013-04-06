// JavaScript Document
function getAjax(url, params, eID, method, dataType, showLoading, onSuccess, onError, onComplete)
{
	showLoading = (typeof(showLoading) === 'undefined' || showLoading === '') ? true : showLoading;
	method = (typeof(method) == 'undefined' || method == '' || (method.toUpperCase() != 'POST' && method.toUpperCase() != 'GET') ) ? 'GET' : method.toUpperCase();
	dataType = (typeof(dataType) == 'undefined' || dataType == '') ? 'html' : dataType;
	
	if(typeof(onSuccess) == 'undefined' || onSuccess == '')
	{
		var _onSucess = function(data)
		{
			if(dataType.toLocaleLowerCase() == 'json')
			{
				$(eID).html(data.form);
			}
			else
			{
				$(eID).html(data);
			}
		};
	}
	else
	{
		var _onSucess = onSuccess;
	}
	
	if(typeof(onError) == 'undefined' || onError == '')
	{
		var _onError = function(jqXHR, textStatus, errorThrown){
			try {
				$(eID).html("Sorry. There was an error.");
			}
			catch (e) {
				alert("Sorry. There was an error.");
			}
		};
	}
	else
	{
		var _onError = onError;
	}
	
	if(typeof(onComplete) == 'undefined' || onComplete == '')
	{
		var _onComplete = function(jqXHR, textStatus){
		};
	}
	else
	{
		var _onComplete = onComplete;
	}
	
	if(showLoading)
	{
		//var h=parseInt($('#'+eID).offset().top);
		//h=(h==0)?'auto':(h+"px");
		$(eID).html('<span class="ajaxLoading">&nbsp;</span>');
	}
	$.ajax({
		   		type: method,
				url: url,
				dataType: dataType,
				data: params,
				success: _onSucess,
				error: _onError,
				complete: _onComplete
			 });
}

function getQueryParam(paramName) {
	strQuery = window.location.search.substring(1);
	arrParam = strQuery.split("&");
	for (i=0;i<arrParam.length;i++)
	{
		var paramItem = arrParam[i].split("=");
		if (paramItem[0] == paramName)
		{
			return paramItem[1];
		}
	}
	return '';
}

function isIntNumber(sText)
{
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length; i++) 
   { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1 || sText.charAt(0) == "0")
      {
         IsNumber = false;
         break;
      }
   }
   return IsNumber;
}

function strIsNumber(sText)
{
	var ValidChars = "0123456789";
	var IsNumber=true;
	var Char;
	for (i = 0; i < sText.length; i++) 
	{ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1)
		{
			IsNumber = false;
			break;
		}
	}
	return IsNumber;
}

function getNumberFromStr(sText)
{
	var ValidChars = "0123456789";
	var relNumber='';
	var Char;
	for (i = 0; i < sText.length; i++) 
	{ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) != -1)
		{
			relNumber += Char;
		}
	}
	return relNumber;
}

// arrAllowType:  array('.jpg', '.gif', '.png')
function uploadValidExtension(fileName, arrAllowType)
{
    if(fileName == "")
    {
        return false;
    }
    fileName = fileName.toLowerCase();
    var extension     = fileName.substr(fileName.lastIndexOf('.'), fileName.length);
    var check = false;
    for(var i in arrAllowType)
    {
        if(arrAllowType[i] == extension)
        {
            check = true;
            break;
        }
    }    
    return check;
}// JavaScript Document

function isUrl(urlStr) {
    if (urlStr.indexOf(' ') != -1) {
        return false;
    }
   
    if (urlStr == '' || urlStr == null) {
        return false;
    }
        
   	var RegexUrl=/(https|http):\/\/([a-z0-9\-._~%!$&'()*+,;=]+@)?([a-z0-9\-._~%]+|\[[a-f0-9:.]+\]|\[v[a-f0-9][a-z0-9\-._~%!$&'()*+,;=:]+\])(:[0-9]+)?(.*)/i;
    
  	var chk = false;
    if(RegexUrl.test(urlStr)){
        chk = true;
    }else{
        chk = false;
    }
    
    if(chk)
    {

	    var rex = /(https|http):\/\/w{1,}\./i;
		if(rex.test(urlStr))
		{
			var RegexUrl2 =/(https|http):\/\/(w{3,3})\./i;
		    if(RegexUrl2.test(urlStr))
			{
				var reg3 = /(https|http):\/\/(www\.){1}/i;
				if(reg3.test(urlStr))
				{
					chk = true;
				}
				else
				{
					chk = false;
				}
				/*
				var arr = urlStr.toLowerCase().split('www.');
		        var num = 0;
		        for(var i=0; i < arr.length; i++)
		        {
		        	if(arr[i] == '')
		        	{
		        		num++;
		        	}
		        }
				chk = (num == 0) ? true : false;
				*/
				
		    }
			else
			{
		        chk = false;
		    }
		}
		
		// check duplicate http
		if(urlStr.lastIndexOf('?') != -1)
		{
			var tmpArr = urlStr.split('?');
			var tmp = tmpArr[0].toLowerCase();
			if(tmp.lastIndexOf('http') >0 )
			{
				chk = false;
			}
		}
		else
		{
			var tmp = urlStr.toLowerCase();
			if(tmp.lastIndexOf('http') > 0)
			{
				chk = false;
			}
		}
		
		// check dot charachter
		if(urlStr.lastIndexOf('.') == -1)
		{
			chk = false;
		}
		
    }
    return chk;
}

var Encoder = {

	// When encoding do we convert characters into html or numerical entities
	EncodeType : "entity",  // entity OR numerical

	isEmpty : function(val){
		if(val){
			return ((val===null) || val.length==0 || /^\s+$/.test(val));
		}else{
			return true;
		}
	},
	arr1: new Array('&nbsp;','&iexcl;','&cent;','&pound;','&curren;','&yen;','&brvbar;','&sect;','&uml;','&copy;','&ordf;','&laquo;','&not;','&shy;','&reg;','&macr;','&deg;','&plusmn;','&sup2;','&sup3;','&acute;','&micro;','&para;','&middot;','&cedil;','&sup1;','&ordm;','&raquo;','&frac14;','&frac12;','&frac34;','&iquest;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;','&Aring;','&Aelig;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&ETH;','&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;','&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&aring;','&aelig;','&ccedil;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&eth;','&ntilde;','&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&divide;','&Oslash;','&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&thorn;','&yuml;','&quot;','&amp;','&lt;','&gt;','&oelig;','&oelig;','&scaron;','&scaron;','&yuml;','&circ;','&tilde;','&ensp;','&emsp;','&thinsp;','&zwnj;','&zwj;','&lrm;','&rlm;','&ndash;','&mdash;','&lsquo;','&rsquo;','&sbquo;','&ldquo;','&rdquo;','&bdquo;','&dagger;','&dagger;','&permil;','&lsaquo;','&rsaquo;','&euro;','&fnof;','&alpha;','&beta;','&gamma;','&delta;','&epsilon;','&zeta;','&eta;','&theta;','&iota;','&kappa;','&lambda;','&mu;','&nu;','&xi;','&omicron;','&pi;','&rho;','&sigma;','&tau;','&upsilon;','&phi;','&chi;','&psi;','&omega;','&alpha;','&beta;','&gamma;','&delta;','&epsilon;','&zeta;','&eta;','&theta;','&iota;','&kappa;','&lambda;','&mu;','&nu;','&xi;','&omicron;','&pi;','&rho;','&sigmaf;','&sigma;','&tau;','&upsilon;','&phi;','&chi;','&psi;','&omega;','&thetasym;','&upsih;','&piv;','&bull;','&hellip;','&prime;','&prime;','&oline;','&frasl;','&weierp;','&image;','&real;','&trade;','&alefsym;','&larr;','&uarr;','&rarr;','&darr;','&harr;','&crarr;','&larr;','&uarr;','&rarr;','&darr;','&harr;','&forall;','&part;','&exist;','&empty;','&nabla;','&isin;','&notin;','&ni;','&prod;','&sum;','&minus;','&lowast;','&radic;','&prop;','&infin;','&ang;','&and;','&or;','&cap;','&cup;','&int;','&there4;','&sim;','&cong;','&asymp;','&ne;','&equiv;','&le;','&ge;','&sub;','&sup;','&nsub;','&sube;','&supe;','&oplus;','&otimes;','&perp;','&sdot;','&lceil;','&rceil;','&lfloor;','&rfloor;','&lang;','&rang;','&loz;','&spades;','&clubs;','&hearts;','&diams;'),
	arr2: new Array('&#160;','&#161;','&#162;','&#163;','&#164;','&#165;','&#166;','&#167;','&#168;','&#169;','&#170;','&#171;','&#172;','&#173;','&#174;','&#175;','&#176;','&#177;','&#178;','&#179;','&#180;','&#181;','&#182;','&#183;','&#184;','&#185;','&#186;','&#187;','&#188;','&#189;','&#190;','&#191;','&#192;','&#193;','&#194;','&#195;','&#196;','&#197;','&#198;','&#199;','&#200;','&#201;','&#202;','&#203;','&#204;','&#205;','&#206;','&#207;','&#208;','&#209;','&#210;','&#211;','&#212;','&#213;','&#214;','&#215;','&#216;','&#217;','&#218;','&#219;','&#220;','&#221;','&#222;','&#223;','&#224;','&#225;','&#226;','&#227;','&#228;','&#229;','&#230;','&#231;','&#232;','&#233;','&#234;','&#235;','&#236;','&#237;','&#238;','&#239;','&#240;','&#241;','&#242;','&#243;','&#244;','&#245;','&#246;','&#247;','&#248;','&#249;','&#250;','&#251;','&#252;','&#253;','&#254;','&#255;','&#34;','&#38;','&#60;','&#62;','&#338;','&#339;','&#352;','&#353;','&#376;','&#710;','&#732;','&#8194;','&#8195;','&#8201;','&#8204;','&#8205;','&#8206;','&#8207;','&#8211;','&#8212;','&#8216;','&#8217;','&#8218;','&#8220;','&#8221;','&#8222;','&#8224;','&#8225;','&#8240;','&#8249;','&#8250;','&#8364;','&#402;','&#913;','&#914;','&#915;','&#916;','&#917;','&#918;','&#919;','&#920;','&#921;','&#922;','&#923;','&#924;','&#925;','&#926;','&#927;','&#928;','&#929;','&#931;','&#932;','&#933;','&#934;','&#935;','&#936;','&#937;','&#945;','&#946;','&#947;','&#948;','&#949;','&#950;','&#951;','&#952;','&#953;','&#954;','&#955;','&#956;','&#957;','&#958;','&#959;','&#960;','&#961;','&#962;','&#963;','&#964;','&#965;','&#966;','&#967;','&#968;','&#969;','&#977;','&#978;','&#982;','&#8226;','&#8230;','&#8242;','&#8243;','&#8254;','&#8260;','&#8472;','&#8465;','&#8476;','&#8482;','&#8501;','&#8592;','&#8593;','&#8594;','&#8595;','&#8596;','&#8629;','&#8656;','&#8657;','&#8658;','&#8659;','&#8660;','&#8704;','&#8706;','&#8707;','&#8709;','&#8711;','&#8712;','&#8713;','&#8715;','&#8719;','&#8721;','&#8722;','&#8727;','&#8730;','&#8733;','&#8734;','&#8736;','&#8743;','&#8744;','&#8745;','&#8746;','&#8747;','&#8756;','&#8764;','&#8773;','&#8776;','&#8800;','&#8801;','&#8804;','&#8805;','&#8834;','&#8835;','&#8836;','&#8838;','&#8839;','&#8853;','&#8855;','&#8869;','&#8901;','&#8968;','&#8969;','&#8970;','&#8971;','&#9001;','&#9002;','&#9674;','&#9824;','&#9827;','&#9829;','&#9830;'),
		
	// Convert HTML entities into numerical entities
	HTML2Numerical : function(s){
		return this.swapArrayVals(s,this.arr1,this.arr2);
	},	

	// Convert Numerical entities into HTML entities
	NumericalToHTML : function(s){
		return this.swapArrayVals(s,this.arr2,this.arr1);
	},


	// Numerically encodes all unicode characters
	numEncode : function(s){
		
		if(this.isEmpty(s)) return "";

		var e = "";
		for (var i = 0; i < s.length; i++)
		{
			var c = s.charAt(i);
			if (c < " " || c > "~")
			{
				c = "&#" + c.charCodeAt() + ";";
			}
			e += c;
		}
		return e;
	},
	
	// HTML Decode numerical and HTML entities back to original values
	htmlDecode : function(s){

		var c,m,d = s;
		
		if(this.isEmpty(d)) return "";

		// convert HTML entites back to numerical entites first
		d = this.HTML2Numerical(d);
		
		// look for numerical entities &#34;
		arr=d.match(/&#[0-9]{1,5};/g);
		
		// if no matches found in string then skip
		if(arr!=null){
			for(var x=0;x<arr.length;x++){
				m = arr[x];
				c = m.substring(2,m.length-1); //get numeric part which is refernce to unicode character
				// if its a valid number we can decode
				if(c >= -32768 && c <= 65535){
					// decode every single match within string
					d = d.replace(m, String.fromCharCode(c));
				}else{
					d = d.replace(m, ""); //invalid so replace with nada
				}
			}			
		}

		return d;
	},		

	// encode an input string into either numerical or HTML entities
	htmlEncode : function(s,dbl){
			
		if(this.isEmpty(s)) return "";

		// do we allow double encoding? E.g will &amp; be turned into &amp;amp;
		dbl = dbl || false; //default to prevent double encoding
		
		// if allowing double encoding we do ampersands first
		if(dbl){
			if(this.EncodeType=="numerical"){
				s = s.replace(/&/g, "&#38;");
			}else{
				s = s.replace(/&/g, "&amp;");
			}
		}

		// convert the xss chars to numerical entities ' " < >
		s = this.XSSEncode(s,false);
		
		if(this.EncodeType=="numerical" || !dbl){
			// Now call function that will convert any HTML entities to numerical codes
			s = this.HTML2Numerical(s);
		}

		// Now encode all chars above 127 e.g unicode
		s = this.numEncode(s);

		// now we know anything that needs to be encoded has been converted to numerical entities we
		// can encode any ampersands & that are not part of encoded entities
		// to handle the fact that I need to do a negative check and handle multiple ampersands &&&
		// I am going to use a placeholder

		// if we don't want double encoded entities we ignore the & in existing entities
		if(!dbl){
			s = s.replace(/&#/g,"##AMPHASH##");
		
			if(this.EncodeType=="numerical"){
				s = s.replace(/&/g, "&#38;");
			}else{
				s = s.replace(/&/g, "&amp;");
			}

			s = s.replace(/##AMPHASH##/g,"&#");
		}
		
		// replace any malformed entities
		s = s.replace(/&#\d*([^\d;]|$)/g, "$1");

		if(!dbl){
			// safety check to correct any double encoded &amp;
			s = this.correctEncoding(s);
		}

		// now do we need to convert our numerical encoded string into entities
		if(this.EncodeType=="entity"){
			s = this.NumericalToHTML(s);
		}

		return s;					
	},

	// Encodes the basic 4 characters used to malform HTML in XSS hacks
	XSSEncode : function(s,en){
		if(!this.isEmpty(s)){
			en = en || true;
			// do we convert to numerical or html entity?
			if(en){
				s = s.replace(/\'/g,"&#39;"); //no HTML equivalent as &apos is not cross browser supported
				s = s.replace(/\"/g,"&quot;");
				s = s.replace(/</g,"&lt;");
				s = s.replace(/>/g,"&gt;");
			}else{
				s = s.replace(/\'/g,"&#39;"); //no HTML equivalent as &apos is not cross browser supported
				s = s.replace(/\"/g,"&#34;");
				s = s.replace(/</g,"&#60;");
				s = s.replace(/>/g,"&#62;");
			}
			return s;
		}else{
			return "";
		}
	},

	// returns true if a string contains html or numerical encoded entities
	hasEncoded : function(s){
		if(/&#[0-9]{1,5};/g.test(s)){
			return true;
		}else if(/&[A-Z]{2,6};/gi.test(s)){
			return true;
		}else{
			return false;
		}
	},

	// will remove any unicode characters
	stripUnicode : function(s){
		return s.replace(/[^\x20-\x7E]/g,"");
		
	},

	// corrects any double encoded &amp; entities e.g &amp;amp;
	correctEncoding : function(s){
		return s.replace(/(&amp;)(amp;)+/,"$1");
	},


	// Function to loop through an array swaping each item with the value from another array e.g swap HTML entities with Numericals
	swapArrayVals : function(s,arr1,arr2){
		if(this.isEmpty(s)) return "";
		var re;
		if(arr1 && arr2){
			//ShowDebug("in swapArrayVals arr1.length = " + arr1.length + " arr2.length = " + arr2.length)
			// array lengths must match
			if(arr1.length == arr2.length){
				for(var x=0,i=arr1.length;x<i;x++){
					re = new RegExp(arr1[x], 'g');
					s = s.replace(re,arr2[x]); //swap arr1 item with matching item from arr2	
				}
			}
		}
		return s;
	},

	inArray : function( item, arr ) {
		for ( var i = 0, x = arr.length; i < x; i++ ){
			if ( arr[i] === item ){
				return i;
			}
		}
		return -1;
	}

};

var UrlEncode = {
 
	// public method for url encoding
	encode : function (string) {
		return escape(this._utf8_encode(string));
	},
 
	// public method for url decoding
	decode : function (string) {
		return this._utf8_decode(unescape(string));
	},
 
	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
 
	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
		return string;
	}
};

var Utf8 = {
 
	// public method for url encoding
	encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
 
	// public method for url decoding
	decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
 
}
function toUnicode(theString) {
	var unicodeString = '';
	for (var i=0; i < theString.length; i++) 
	{
		var theUnicode = theString.charCodeAt(i).toString(16).toUpperCase();
		while (theUnicode.length < 4) {
	    	theUnicode = '0' + theUnicode;
	    }
		theUnicode = '\\u' + theUnicode;
	    unicodeString += theUnicode;
	}
  	return unicodeString;
}

var UTF8 = {
	encode: function(s){
		for(var c, i = -1, l = (s = s.split("")).length, o = String.fromCharCode; ++i < l;
			s[i] = (c = s[i].charCodeAt(0)) >= 127 ? o(0xc0 | (c >>> 6)) + o(0x80 | (c & 0x3f)) : s[i]
		);
		return s.join("");
	},
	decode: function(s){
		for(var a, b, i = -1, l = (s = s.split("")).length, o = String.fromCharCode, c = "charCodeAt"; ++i < l;
			((a = s[i][c](0)) & 0x80) &&
			(s[i] = (a & 0xfc) == 0xc0 && ((b = s[i + 1][c](0)) & 0xc0) == 0x80 ?
			o(((a & 0x03) << 6) + (b & 0x3f)) : o(128), s[++i] = "")
		);
		return s.join("");
	}
};

function stripHtmlTags(str)
{
	return str.replace(/<\/?[^>]+>/gi, '');
}

function validHtmlTags(v) {
	return(v.match(/(<+[^>]*?>)/g));
}

function chkHtmlTags(str)
{
	var check = false;
	if (str.match(/<\/?[^>]+>/gi)) {
		check = true;
	}
	return check;
}

function getSelText()
{
    var txt = '';
    if (window.getSelection)
    {
        txt = window.getSelection();
	}
    else if (document.getSelection)
    {
        txt = document.getSelection();
    }
    else if (document.selection)
    {
        txt = document.selection.createRange().text;
    }
	return txt;
}

function getDomainFromUrl(strUrl)
{
	if(strUrl == '') return '';
	try
	{
		var temp = strUrl.split('?', 1);
		var domain = temp[0];
		domain = domain.match(/:\/\/(.[^/]+)/)[1];
		domain = domain.replace(/www./i, '');
		return domain;
	}
	catch(err)
	{
		return '';
	}
}

function validateUsername(uname) {
    var error = "";
    uname = uname.toLowerCase();
    //var illegalChars = /\W/; // allow letters, numbers, and underscores
    var rexFilter = /^([a-z])([a-z0-9_])*/; // allow letters, numbers, and underscores and start by one letter
 
    if (uname == "") {
        error = "Bạn hãy nhập Tên đăng nhập.";
    } else if ((uname.length < 4) || (uname.length > 64)) { 
        error = "Tên đăng nhập của bạn quá ngắn, độ dài phải từ 4-64 ký tự!";
    } else if (!rexFilter.test(uname)) { 
        error = "Tên đăng nhập có chứa ký tự không hợp lệ.";
    }
    return error;
}

function validatePassword(pws) {
    var error = "";
    var illegalChars = /[\W_]/; // allow only letters and numbers 
 
    if (pws == "") {
        error = "Bạn chưa nhập Mật khẩu.";
    } else if ((pws.length < 6) || (pws.length > 64)) {
        error = "Mật khẩu của bạn quá ngắn, độ dài mật khẩu từ 6-64 ký tự!";
    } else if (illegalChars.test(pws)) {
        error = "Mật khẩu có chứa ký tự không hợp lệ.";
    }// else if (!((pws.search(/(a-z)+/)) && (pws.search(/(0-9)+/)))) {
       // error = "The password must contain at least one numeral.";
    //}
   return error;
}

function validateEmail(email) {
    var error="";
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/;
   
    if (email == "") {
        error = "Bạn chưa nhập địa chỉ Email.";
    } else if (!emailFilter.test(email)) {              //test email for illegal characters
        error = "Địa chỉ Email không hợp lệ.";
    } else if (email.match(illegalChars)) {
        error = "Địa chỉ Email chứa ký tự không hợp lệ.";
    }
    return error;
}

function isEmail(email)
{
	var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/;
    if (email == "") {
        return false;
    } else if (!emailFilter.test(email)) {              //test email for illegal characters
       return false;
    } else if (email.match(illegalChars)) {
       return false;
    }
    return true;
}

// number format
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1))
	{
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
function roundNumber(num, dec) {
	return Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
}
// end number format

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
            v = obj[n]; t = typeof(v);
            if (t == "string") v = '"'+v+'"';
            else if (t == "object" && v !== null) v = JSON.stringify(v);
            json.push((arr ? "" : '"' + n + '":') + String(v));
        }
        return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
    }
};

var ajaxLoadingPopupStatus = 0;

//loading popup with jQuery magic!
function loadAjaxLoadingPopup(imgId, divBgId){
	//loads popup only if it is disabled
	if(ajaxLoadingPopupStatus==0){
		centerAjaxLoadingPopup(imgId, divBgId);
		$(divBgId).css({
			"opacity": "0.5"
		});
		$(divBgId).fadeIn("fast");
		$(imgId).fadeIn("fast");
		ajaxLoadingPopupStatus = 1;
		
	}
}

//disabling popup with jQuery magic!
function disableAjaxLoadingPopup(imgId, divBgId){
	//disables popup only if it is enabled
	if(ajaxLoadingPopupStatus==1){
		$(divBgId).fadeOut();
		$(divBgId).hide();
		
		ajaxLoadingPopupStatus = 0;
	}
	$(imgId).hide();
}

//centering popup
function centerAjaxLoadingPopup(imgId, divBgId){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var bodywidth = $('body').innerWidth();
	var bodyheight = $('body').innerHeight();
	var popupHeight = $(imgId).height();
	var popupWidth = $(imgId).width();
	
	var wpos = (bodywidth > windowWidth) ? bodywidth : windowWidth;
	var hpos = (bodyheight > windowHeight) ? bodyheight : windowHeight;
	var scrollWindow = $(window).scrollTop();
	var top = windowHeight/2-((popupHeight/3)*2) + scrollWindow;
	var left = windowWidth/2-popupWidth/2;
	
	//centering
	$(imgId).css({
		"position": "absolute",
		"top": top,
		"left": left
	});
	//only need force for IE6
	$(divBgId).css({
		"height": hpos,
		"width" : wpos
	});

	$(window).scroll(function(){		
		if($(imgId).css('display') != 'none')
		{
			$(imgId).stop();
			var scroll = $(window).scrollTop();
			var scrollPos = windowHeight/2-((popupHeight/3)*2) + scroll;
			$(imgId).animate({top: scrollPos},'slow');
		}
	});
}

function htmlspecialchars_decode (string, quote_style) {
    // http://kevin.vanzonneveld.net
    // +   original by: Mirek Slugen
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Mateusz "loonquawl" Zalega
    // +      input by: ReverseSyntax
    // +      input by: Slawomir Kaniecki
    // +      input by: Scott Cariss
    // +      input by: Francois
    // +   bugfixed by: Onno Marsman
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Ratheous
    // +      input by: Mailfaker (http://www.weedem.fr/)
    // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
    // +    bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: htmlspecialchars_decode("<p>this -&gt; &quot;</p>", 'ENT_NOQUOTES');
    // *     returns 1: '<p>this -> &quot;</p>'
    // *     example 2: htmlspecialchars_decode("&amp;quot;");
    // *     returns 2: '&quot;'
    var optTemp = 0,
        i = 0,
        noquotes = false;
    if (typeof quote_style === 'undefined') {
        quote_style = 2;
    }
    string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
    var OPTS = {
        'ENT_NOQUOTES': 0,
        'ENT_HTML_QUOTE_SINGLE': 1,
        'ENT_HTML_QUOTE_DOUBLE': 2,
        'ENT_COMPAT': 2,
        'ENT_QUOTES': 3,
        'ENT_IGNORE': 4
    };
    if (quote_style === 0) {
        noquotes = true;
    }
    if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
        quote_style = [].concat(quote_style);
        for (i = 0; i < quote_style.length; i++) {
            // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
            if (OPTS[quote_style[i]] === 0) {
                noquotes = true;
            } else if (OPTS[quote_style[i]]) {
                optTemp = optTemp | OPTS[quote_style[i]];
            }
        }
        quote_style = optTemp;
    }
    if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
        string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
        // string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
    }
    if (!noquotes) {
        string = string.replace(/&quot;/g, '"');
    }
    // Put this in last place to avoid escape being double-decoded
    string = string.replace(/&amp;/g, '&');

    return string;
}

function httooltip(e, strTipBody, width, xOffset, yOffset, posShow, pos)
{	
	width = (typeof(width) === 'undefined' || width === '') ? 200 : width;
	xOffset = (typeof(xOffset) === 'undefined' || xOffset === '') ? 40 : xOffset;
	yOffset = (typeof(yOffset) === 'undefined' || yOffset === '') ? 0 : yOffset;
	posShow = (typeof(posShow) === 'undefined' || posShow === '') ? 'down' : posShow;
	posShow = posShow.toLowerCase();
	pos = (typeof(pos) === 'undefined' || pos === '') ? '' : pos;
	var chk = false;
	
	if(pos == '')
	{
		chk = true;
	}
	else
	{
		var cookieChk = getCookie('capu');
		if(cookieChk == '')
		{
			setCookie('capu', '0', 36500, 0);
			cookieChk = 0;
		}
		cookieChk = parseInt(cookieChk, 10);
		pos = parseInt(pos, 10);
		chk = (cookieChk&pos) ? false : true;
	}
	if(chk)
	{
		setCookie('capu', (pos|cookieChk), 36500, 1);
		if(strTipBody != '')
		{
			if(posShow == 'down')
			{
				$('#ht-tooltip').width(width);
				$("#ht-tooltip-inner").html(strTipBody);
				
				var ttipW = $('#ht-tooltip').width();
				var ttipH = $('#ht-tooltip').height();
				
				var pos = $(e).offset();
				var eWidth = $(e).outerWidth();
				var eHeight = $(e).outerHeight();
				ttipW = eWidth;
				$('#ht-tooltip').width(ttipW);
				
				$("#ht-tooltip").css('z-index','-1000001001');
				$("#ht-tooltip").show();
								
				var ttop = pos.top - yOffset - ttipH;
				var tleft = pos.left - xOffset;
				
				$("#ht-tooltip").css("top",ttop + "px");
				$("#ht-tooltip").css("left",tleft + "px");
				$("#ht-tooltip").css('z-index','1000001001');
			}
			else if(posShow == 'right')
			{
				$('#ht-r-tooltip').width(width);
				$("#ht-r-tooltip-inner").html(strTipBody);
				
				var ttipW = $('#ht-r-tooltip').width();
				var ttipH = $('#ht-r-tooltip').height();
				
				if((ttipW/ttipH) < 3)
				{
					ttipW = ttipH * 3;
					ttipW = (ttipW > 450) ? 450 : ttipW;
					$('#ht-r-tooltip').width(ttipW);
				}
				var pos = $(e).offset();
				var eWidth = $(e).outerWidth();
				var eHeight = $(e).outerHeight();
				
				$("#ht-r-tooltip").css('z-index','-1000001001');
				$("#ht-r-tooltip").show();
				
				var ttop = pos.top + yOffset;
				var tleft = pos.left + xOffset + eWidth;
				$("#ht-r-tooltip").css("top",ttop + "px");
				$("#ht-r-tooltip").css("left",tleft + "px");
				$("#ht-r-tooltip").css('z-index','1000001001');
			}		
		}
	}
}
function removeHt_Tooltip(posShow)
{
	posShow = (typeof(posShow) === 'undefined' || posShow === '') ? 'down' : posShow;
	posShow = posShow.toLowerCase();
	if(posShow == 'down')
	{
		$("#ht-tooltip").css('display','none');
		$("#ht-tooltip-inner").html('');
	}
	else if(posShow == 'right')
	{
		$("#ht-r-tooltip").css('display','none');
		$("#ht-r-tooltip-inner").html('');
	}
}
function removeFocusToolTipImage(posShow)
{
	posShow = (typeof(posShow) === 'undefined' || posShow === '') ? 'down' : posShow;
	posShow = posShow.toLowerCase();
	setTimeout('removeHt_Tooltip(\''+posShow+'\')', 0);
}

function setCookie (c_name, value, expiredays, reset) 
{
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + expiredays);
    if (reset == 1) 
	{
        document.cookie = c_name + "=" + escape(value) + ((expiredays == null) ? "" : ";expires=" + exdate.toUTCString()) + ";path=/";
    }
	else
	{
        var curCook = this.getCookie('cpcSelfServ');
        if (curCook.search(value) < 0 || curCook == '' || curCook == null) 
		{
            document.cookie = c_name + "=" + escape(curCook + value) + ((expiredays == null) ? "" : ";expires=" + exdate.toUTCString()) + ";path=/";
        }
    }
}

function getCookie(c_name) 
{
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) c_end = document.cookie.length;
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

function makeSiteUrl(strUri, fixNoSlash)
{
	fixNoSlash = (typeof(fixNoSlash) == 'undefined' || fixNoSlash == '') ? false : fixNoSlash;
	var url = '';
	if(typeof(langcode) == 'undefined' || langcode == '')
	{
		url = (fixNoSlash) ? 'cpc/' + strUri : '/cpc/' +  strUri;
	}
	else
	{
		url = (fixNoSlash) ? 'cpc/' + langcode + '/' + strUri : '/cpc/' + langcode + '/' + strUri;
	}
	return url;
}

function getSysDate()
{
	var tmpCurrDate = new Date();
	var tmpSysHour = tmpCurrDate.getHours();
	if(tmpSysHour < 7)
	{
		tmpCurrDate.setDate(tmpCurrDate.getDate()-1);
	}
	return new Date(tmpCurrDate.getFullYear(), tmpCurrDate.getMonth(), tmpCurrDate.getDate());
}