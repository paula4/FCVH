
var menu =[
  {
    title:'Inicio',
    url:'admin/inicio.html',
    route:'/',
    inmenu:true,
    pos:"left"
  },
  {
    title:'Socios',
    url:'admin/socio.html',
    route:'/socio',
    inmenu:true,
    pos:"left"
  },
  {
    title:'Tienda',
    url:'admin/tienda.html',
    route:'/tienda',
    inmenu:true,
    pos:"left"
  },
  {
    title:'Proximo Partido',
    url:'admin/proximo.html',
    route:'/proximo',
    inmenu:true,
    pos:"left"
  },
  {
    title:'Tabla de posiciones',
    url:'admin/tabla.html',
    route:'/tabla',
    inmenu:true,
    pos:"left"
  },
  {
    title:'Noticias',
    url:'admin/noticias.html',
    route:'/noticias',
    inmenu:true,
    pos:"left"
  },
  {
    title:'Configuración',
    url:'admin/config.html',
    route:'/config',
    inmenu:true,
    pos:"left"
  },
  {
    title:'Cerrar Sesión',
    url:'admin/login.html',
    route:'/login',
    inmenu:true,
    pos:"right"
  },
  {
    title:'404',
    url:'admin/404.html',
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
  function apiError(){
    alert('Error al obtener los datos');
  }
  villa.controller('MenuCtrl', function($scope, $http,$location) {
    $scope.items = menu;
    $scope.bajar = function (url){
      $location.path(url);
      var offs= $("#page").offset().top-100;
      if(url == "/")
      offs = 0;
      $('html, body').animate({
        scrollTop: (offs) + 'px'
      }, 'fast');
      return this;
    };
  });
  var data;
  villa.controller('TablasCtrl', function($scope, $http) {
    var fDatos = 'datos/tablas.json';
    $http({
      method: 'GET',
      url: fDatos
    }).then(function successCallback(response) {
      $scope.datos = response.data;
    }, function errorCallback(response) {
      apiError();
    });
    $("#myList a").tab("show");
  });
  villa.controller('NoticiasCtrl', function($scope, $http) {
    var fDatos = 'datos/noticias.json';
    $http({
      method: 'GET',
      url: fDatos
    }).then(function successCallback(response) {
      $scope.noticias = response.data;

    }, function errorCallback(response) {
      apiError();
    });
    var countDownDate = new Date("Nov 20, 2017 19:00:00").getTime();
    var x = setInterval(function() {
      var now = new Date().getTime();
      var distance = countDownDate - now;
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      document.getElementById("counter").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("counter").innerHTML = "EXPIRED";
      }
    }, 1000);
  });
