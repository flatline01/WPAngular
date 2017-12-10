<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" ng-app="wpangular">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<base href="/">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<header>
	<div class="container">
		<nav ng-controller="topMainNav" menuId="<?php echo(wp_menu_id_by_name( 'primary' )); ?>">
			<script type="text/ng-template" id="menu">
				<a href="{{nav.url}}" target="{{nav.target}}" class="{{nav.cssClass}}" pageId="{{nav.object_id}}" type="{{nav.object}}" ng-Click="pagenav($event)">{{nav.title}}</a>
				<ul ng-if="nav.children ">
					<li ng-repeat="nav in nav.children" ng-include="'menu'">
					</li>
				</ul>
			</script>
			<ul>
				<li ng-repeat="nav in topMainNav" ng-include="'menu'">
					<a href="{{nav.url}}" target="{{nav.target}}" class="{{nav.cssClass}}" pageId="{{nav.object_id}}" type="{{nav.object}}" ng-Click="pagenav($event)">{{nav.title}}</a>
				</li>
			</ul>		
		</nav>
	</div>
</header>

