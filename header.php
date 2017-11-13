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
	<nav ng-controller="topMainNav" menuId="<?php echo(wp_menu_id_by_name( 'primary' )); ?>">
		<ul>
			<li ng-repeat="nav in topMainNav"><a href="{{nav.url}}" target="{{nav.target}}" class="{{nav.classes}}" pageId="{{nav.id}}" type="{{nav.object}}" ng-click="pagenav">{{nav.title}}</a>
				<ul ng-if="nav.children && nav.children.length > 0" class="sub-menu">
					<li ng-repeat="nav in nav.children"><a href="{{nav.url}}" target="{{nav.target}}" class="{{nav.cssClass}}" pageId="{{nav.id}}" type="{{nav.object}}">{{nav.title}}</a>
				</ul>
			</li>
		</ul>
	</nav>
	</div>
</header>

