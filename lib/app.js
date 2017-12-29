// JavaScript Document
angular.element( document.querySelector( 'html.no-js' ) ).removeClass("no-js");

angular.module('wpangular',['ngRoute'])
	.controller('topMainNav', wpangularNavController)
	.controller('maincontent', wpangularMainController);

function wpangularNavController($scope, $element, $attrs, $http){
	"use strict";
	//requires https://wordpress.org/plugins/wp-api-menus/
	//get menuid from the template, create json response url
	//set main content content based on id
	const nav_json_url = '/wp-json/wp-api-menus/v2/menus/' + $attrs.menuid;
	const content_json_url = '/wp-json/wp/v2/pages/';
	var mainContent = angular.element( document.querySelector( '#maincontent' ) );

	$http.get(nav_json_url).then(function(response) {
		$scope.topMainNav = response.data.items;
    });	
	
	$scope.pagenav = function(item){
		var href = item.currentTarget.getAttribute("href");
		var pageID = item.currentTarget.getAttribute("pageid");
		
        if(href.indexOf(location.host)>0){
			item.stopPropagation();
			item.preventDefault();
			mainContent.removeClass("ready").addClass("loading");
			$http.get(content_json_url + pageID).then(function(response) {
				mainContent.html(response.data.content.rendered);
				mainContent.attr("pageid", response.data.id);
				mainContent.removeClass("loading").addClass("ready");
			});
			
		}
		
		
	}
		 
}
function wpangularMainController($scope, $element, $attrs, $http){
	"use strict";
	//get location on load, and load requested page. if not, load the home page.
	console.log(location.pathname);
	$scope.renderedContent ="hey";
	
	
}