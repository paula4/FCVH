var menu =[
  {
    title:'Inicio',
    url:'template/inicio.html',
    route:'/',
    inmenu:true
  },
  {
    title:'Historia',
    url:'template/historia.html',
    route:'/historia',
    inmenu:true
  },
  {
    title:'Pasión',
    url:'template/pasion.html',
    route:'/pasion',
    inmenu:true
  },
  {
    title:'Contacto',
    url:'template/contacto.html',
    route:'/contacto',
    inmenu:true
  },
  {
    title:'Tienda',
    url:'template/shop.html',
    route:'/shop',
    inmenu:true
  },
  {
    title:'404',
    url:'template/404.html',
    route:'/404',
    inmenu:false
  }];
var villa = angular.module('fcvhapp', ['ngRoute',]);
villa.config(['$routeProvider' ,'$locationProvider',
function ($routeProvider, $locationProvider) {
  $locationProvider.hashPrefix('');
  menu.forEach(function (item){
    $routeProvider.when(item.route, {
      templateUrl: item.url
    });
  });
  $routeProvider.otherwise({
    redirectTo: '/404',
  });
}]);

villa.controller('MenuCtrl', ['$scope', function($scope) {
  $scope.items = menu;
}]);
