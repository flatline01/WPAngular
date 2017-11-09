<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" ng-app="wpangular">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<header>
	<div class="container">
	<nav ng-controller="topMainNav">
		<ul>
			<li ng-repeat="nav in topMainNav"><a href="{{nav.url}}" target="{{nav.target}}" class="{{nav.cssClass}}">{{nav.label}}</a>
				<ul ng-if="nav.subpages && nav.subpages.length > 0" class="sub-menu">
					<li ng-repeat="nav in nav.subpages"><a href="{{nav.url}}" target="{{nav.target}}" class="{{nav.cssClass}}">{{nav.label}}</a>
				</ul>
			</li>
		</ul>
	</nav>
	</div>
</header>

