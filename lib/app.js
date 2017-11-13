// JavaScript Document

angular.element( document.querySelector( 'html.no-js' ) ).removeClass("no-js");

angular.module('wpangular',[])
	.controller('topMainNav', wpangularNavController);

function wpangularNavController($scope, $element, $attrs, $http){
	"use strict";
	//requires https://wordpress.org/plugins/wp-api-menus/
	//get menuid from the template, create json response url
	var nav_json_url = '/wp-json/wp-api-menus/v2/menus/' + $attrs.menuid;

	$http.get(nav_json_url).then(function(response) {
		$scope.topMainNav = response.data.items;
    });	
	
	 
}



