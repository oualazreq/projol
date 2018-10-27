'use-strict';

angular.module("app",[]).
    directive("transcodeMenu",function(){
    return{
        restrict:'E',
        replace: true,
        transclude:true,
        scope:false,
        templateUrl: '../templates/menu.html'
    };
});