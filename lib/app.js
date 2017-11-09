// JavaScript Document

angular.module('wpangular',[])
	.controller('topMainNav', wpangularNavController);

function wpangularNavController($scope){
	//temp hard code, replace with call to wp menu json
	$scope.topMainNav = {
		0 :{
			label:"home",
			url:"/",
			target:"",
			cssClass:""
		},
		1 :{
			label:"about",
			url:"/about",
			subpages:[
				{label:"about me", url:"about/me", target:"", cssClass:""},
				{label:"interests", url:"about/interests", target:"", cssClass:""},
			]
		},
		2:{label:"Facebook", url:"http:facebook.com", target:"_blank", cssClass:"fa-fb"},
		3:{label:"Twitter",url:"http://twitter.com", target:"_blank", cssClass:"fa-tw"},
		4:{label:"Instagram",url:"http://intagram.com", target:"_blank", cssClass:"fa-ig"},

	};
}

