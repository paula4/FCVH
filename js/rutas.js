var villa = angular.module('fcvhapp', ['ngRoute',]);
villa.config(['$routeProvider' ,'$locationProvider',
function ($routeProvider, $locationProvider) {
  $locationProvider.hashPrefix('');
  $routeProvider.
  when('/', {
    templateUrl: 'template/inicio.html',
  }).
  when('/historia', {
    templateUrl: 'template/historia.html',
  }).
  when('/pasion', {
    templateUrl: 'template/pasion.html',
  }).
  when('/contacto', {
    templateUrl: 'template/contacto.html',
  }).
  when('/shop', {
    templateUrl: 'template/shop.html',
  }).
  when('/404', {
    templateUrl: 'template/404.html',
  }).
  otherwise({
    redirectTo: '/404',
  });
}]);
