'use strict';

angular.module("app", ['auth0', 'angular-storage', 'angular-jwt', 'ngRoute','angularFileUpload','ui.bootstrap','angular-stripe','stripe.checkout','ngFileSaver'])
    .run(function($rootScope, auth, store, jwtHelper, $location) {
        auth.hookEvents();
        $rootScope.$on('$locationChangeStart', function() {

            var token = store.get('profile_token');
            if (token) {
                if (!jwtHelper.isTokenExpired(token)) {
                    if (!auth.isAuthenticated) {
                        //Re-authenticate user if token is valid
                        auth.authenticate(store.get('profile'), token);
                    }
                } else {
                    // Either show the login page or use the refresh token to get a new idToken
                    $location.path('/');
                }
            }
        });
    })

    .config( function myAppConfig ( $routeProvider, authProvider, $httpProvider, $locationProvider,
                                    jwtInterceptorProvider,stripeProvider) {

        $routeProvider
            .when( '/', {
                controller: 'home',
                templateUrl: '../templates/home.html',
                requiresLogin: true
            }).when( '/api/paiement', {
                controller: 'home',
                templateUrl: '../templates/home.html',
                requiresLogin: true
            })
            .when( '/login', {
                controller: 'home',
                templateUrl: '../templates/login.html',
                pageTitle: 'Login'
            });

        authProvider.init({
            domain: 'sup-transcode.eu.auth0.com',
            clientID: '2gTJG2TqtinuJm39dGHXY75Nqm1AMePT',
            loginUrl: '/login'
        });
        //Called when login is successful
        authProvider.on('loginSuccess', function($location, profilePromise, idToken, store,$http,$rootScope) {
            console.log("Login Success");

            var transcodeUser = {};
            transcodeUser.userSpace = {};


            profilePromise.then(function(profile) {

                transcodeUser.mail = profile.email;
                transcodeUser.userSpace.path = profile.clientID;

                store.set('profile', profile);
                store.set('profile_token', idToken);
                $http.post('/api/users',transcodeUser);

                $rootScope.convertedVideos = $http.get("/api/convertedVideoss",{params:{mail: store.get('profile').email}}).then(function(response){

                    return response.data;
                });
            });


            stripeProvider.setPublishableKey('pk_test_eY5uvZWmoacYAsjn88HQfpAw');


            $location.path('/');
        });


        //Called when login fails
        authProvider.on('loginFailure', function() {
            console.log("Error logging in");
            $location.path('/login');
        });
        jwtInterceptorProvider.tokenGetter = function(store) {
            return store.get('profile_token');
        }

        //Push interceptor function to $httpProvider's interceptors
        $httpProvider.interceptors.push('jwtInterceptor');

    })
    .controller("home", function($scope,auth,userService,FileUploader,$uibModal,$http,$location,stripe,store,FileSaver) {
        var self = this;
        self.items_price = 0;
        $scope.afterPay = false;
        $scope.hideUploadAndPrice=true;


        //AUthentication
        $scope.auth = auth;

        self.logout = function() {
            auth.signout();
            store.remove('profile');
            store.remove('profile_token');
            $location.path('/login');
        };

        //Uploader
        if(store.get('profile')){

        }

        var uploader = $scope.uploader = new FileUploader({url:"/api/videos/"} );
        $scope.userSpaceSize=0;
      /*  var getUserSpaceSize = function(){

            var email = (store.get('profile')?store.get('profile').email:null);
            $http.get("/api/users/space",{params:{mail: email}}).then(function(response){
                console.log(response);
                $scope.userSpaceSize = response.data.size;
            });
        };
*/
        var email = (store.get('profile')?store.get('profile').email:null);
        $http.get("/api/users/space",{params:{mail: email}}).then(function(response){
            console.log(response);
            $scope.userSpaceSize = response.data.size;
        });
        uploader.onBeforeUploadItem = function(item) {


        };

        uploader.onAfterAddingFile = function(item) {
            var clientIdName = (store.get('profile')?store.get('profile').clientID+"/uploads/":"")+item.file.name;

            item.file.name=clientIdName;
            $scope.showConvertMessage = false;

        };
        uploader.onProgressItem = function(fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader.onSuccessItem = function(fileItem, response, status, headers) {
            // console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploader.onErrorItem = function(fileItem, response, status, headers) {
            //console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function(fileItem, response, status, headers) {
            // console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader.onCompleteItem = function(fileItem, response, status, headers) {
            //console.info('onCompleteItem', fileItem, response, status, headers);

            /*console.log(response);*/
            self.items_price += response.price;
            $scope.afterPay = false;
        };
        $scope.spaceIsSufficient = true;

        uploader.onAfterAddingAll = function(addedFileItems) {


            var queueSize=0;

            console.info('onAfterAddingAll', addedFileItems);
            self.items_price = 0;
            angular.forEach(addedFileItems,function(value,key){

                queueSize += value._file.size
            });
            console.log($scope.userSpaceSize);
            var remainingSize = 10*Math.pow(1024,3)-$scope.userSpaceSize;
            console.log(remainingSize);

            if(remainingSize<=queueSize){
                $scope.spaceIsSufficient = false;
            }
            else {
                $scope.spaceIsSufficient = true;
            }
            console.log($scope.spaceIsSufficient);
        };
        uploader.onCompleteAll = function() {

            self.items_price_show = true;
            $scope.hideUploadAndPrice=false;
            console.info('onCompleteAll');
            console.info(self.items_price);

        };

        var controller = $scope.controller = {
            isVideo: function(item) {
                var type = '|' + item._file.type.slice(item._file.type.lastIndexOf('/') + 1) + '|';
                return '|mpeg|flv|avi|mp4|'.indexOf(type) !== -1;
            }
        };
        var data = {
            "intent":"sale",
            "redirect_urls":{
                "return_url":"http://example.com/your_redirect_url.html",
                "cancel_url":"http://example.com/your_cancel_url.html"
            },
            "payer":{
                "payment_method":"paypal"
            },
            "transactions":[
                {
                    "amount":{
                        "total":"7.47",
                        "currency":"USD"
                    }
                }
            ]
        };


        uploader.filters.push({
            name: 'customFilter',
            fn: function(item /*{File|FileLikeObject}*/, options) {
                return this.queue.length < 10;
            }
        });

        //Stripe

        $scope.charge = function () {

            return stripe.card.createToken($scope.payment.card)
                .then(function (response) {
                    console.log('token created for card ending in ', response.card.last4);
                    var payment = angular.copy($scope.payment);
                    payment.card = void 0;
                    payment.token = response.id;
                    return $http.post('https://yourserver.com/payments', payment);
                })
                .then(function (payment) {
                    console.log('successfully submitted payment for $', payment.amount);
                })
                .catch(function (err) {
                    if (err.type && /^Stripe/.test(err.type)) {
                        console.log('Stripe error: ', err.message);
                    }
                    else {
                        console.log('Other error occurred, possibly with your API', err.message);
                    }
                });
        };


        //paiment modal

        $scope.items = uploader.queue;
        $scope.animationsEnabled = true;

        $scope.open = function () {

            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                resolve: {
                    items: function () {
                        return $scope.items;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                $scope.selected = selectedItem;
            }, function () {

            });
        };

        $scope.toggleAnimation = function () {
            $scope.animationsEnabled = !$scope.animationsEnabled;
        };

        this.doCheckout = function(response) {
            console.log(response);
            //console.log($scope.payment);
            var payment = {};
            payment.token = response.id;
            payment.card = response.card;
            payment.amount = 50;
            //$http.post('api/payment/', payment);
            $http.post('/api/payment', payment).then(function(response){

                self.formats = response.data;
                $scope.afterPay = true;
            });




            /*$scope.charge = function () {
             return stripe.card.createToken($scope.payment.card)
             .then(function (response) {
             console.log('token created for card ending in ', response.card.last4);
             var payment = angular.copy($scope.payment);
             payment.card = void 0;
             payment.token = response.id;
             return $http.post('https://yourserver.com/payments', payment);
             })
             .then(function (payment) {
             console.log('successfully submitted payment for $', payment.amount);
             })
             .catch(function (err) {
             if (err.type && /^Stripe/.test(err.type)) {
             console.log('Stripe error: ', err.message);
             }
             else {
             console.log('Other error occurred, possibly with your API', err.message);
             }
             });
             };*/

        };

        $scope.convertModel = {
            fromFile: "",
            toFormat: "",
            mail:""
        };


        //$scope.convertedVideos = [];
        var email = (store.get('profile')?store.get('profile').email:null);

        $scope.convertedVideos = [];

        if(email!=null){
            $http.get("/api/convertedVideoss",{params:{mail: email}}).then(function(response){

                console.log(response);
                $scope.convertedVideos=response.data;
            });
        }

        this.download = function(name){
            window.open( "/api/videos/"+(store.get('profile')?store.get('profile').clientID:"null")+"/"+name+"/"+name.split(".")[1]);
        };

        $scope.showConvertMessage = false;

        $scope.convert = function(){
            console.log($scope.convertModel);
            $scope.convertModel.mail = store.get('profile')?store.get('profile').email:"null";
            $http.post("/api/convert",$scope.convertModel).then(function(response){


                console.log(response.data);

                $scope.convertedVideos.push(response.data);


                console.log($scope.convertedVideos);

            });

            $scope.afterPay=false;
            uploader.queue = [];
            $scope.showConvertMessage = true;
            $scope.hideUploadAndPrice=true;
            self.items_price = 0;

        };


    })
    .controller('ModalInstanceCtrl', function ($scope,$uibModalInstance, items) {

        $scope.items = items;
        $scope.selected = {
            item: $scope.items[0]
        };

        $scope.ok = function () {
            $uibModalInstance.close($scope.selected.item);
        };


    })

    .directive("transcodeMenu",function(){
        return{
            restrict:'E',
            replace: true,
            transclude:true,
            scope:false,
            templateUrl: '../templates/menu.html'
        };
    })

    .factory("userService", function($http){

        return{
            createUser: function(User){

                $http.post('/api/user',User).then(function(response){

                    return response.data;
                });

            },
            deleteUser: function(){

            }
        }
    })
;