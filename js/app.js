(function(angular) {
	'use strict';
	var g2gApp = angular.module('g2gApp', ['ngAnimate', 'ngRoute', 'ui.bootstrap']);
	var webRoot = window.document.location.pathname+'api/web/';

	g2gApp.config(function($routeProvider){
		$routeProvider
		.when('/', {
			templateUrl: 'home.html',
			controller: 'mainController'	
		})
		.when('/mywarranty', {
			templateUrl: 'myImformation.html',
			controller: 'myWarrantyController'
		})
		.when('/about', {
			templateUrl: 'About_Us.html',
			controller: 'aboutController'
		})
		.when('/products/:pid/:cid', {
			templateUrl: 'product-list.html',
			controller: 'productListController'
		})
		.when('/product/:url', {
			templateUrl: 'product.html',
			controller: 'productController'
		})

		.when('/services', {
			templateUrl: 'Services.html',
			controller: 'servicesController'
		})
		.when('/category', {
			templateUrl: 'category.html',
			controller: 'categoryController'
		})
		.when('/register', {
			templateUrl: 'register.html',
			controller: 'registerController'
		})
		.when('/login', {
				templateUrl: 'logIn.html',
				controller: 'loginController'
		})
		.when('/support/:id', {
			templateUrl: 'support.html',
			controller: 'supportController'
		})
		.when('/usercenter/:id', {
			templateUrl: 'mycenter.html',
			controller: 'mycenterController'
		})

		.otherwise({redirectTo: '/'});
	});

	g2gApp.controller('mainController', function($scope,$http,$window,$rootScope) {
        $scope.reg = {};
		$scope.log = {};
		$scope.register = function(){
			 $http.post(webRoot+'user/signup', $scope.reg).success(
                function (data) {
                	if(data.success == true)
                	{
						console.log($scope.reg);

                		$window.localStorage['user'] = JSON.stringify(data.data);
                		$rootScope.user = data.data;
                		$http.defaults.headers.common['Authorization'] = 'Basic ' + $scope.user.auth_key;

                	}
                	else
                	{
                		angular.forEach(data.data, function (error) {
                            $scope.error = error.message;
                    	});
                	}
            });

		}
		$scope.login = function()
		{

			$http.post(webRoot+'user/login', $scope.log).success(
                function (data) {

                	if(data.success == true)
                	{
                		$window.localStorage['user'] = JSON.stringify(data.data);
                		$rootScope.user = data.data;
						$rootScope.templateUrl = 'home.html';
                		$http.defaults.headers.common['Authorization'] = 'Basic ' + $scope.user.auth_key;
                		$window.location.href = '/'
                	}
                	else
                	{
                		var err = '';
                		angular.forEach(data.message, function (v,k) {
                            err += "<span class='error'>"+v[0]+"</span>";
                    	});
                    	$(".js-validator-messages").html(err).show();
                	}
            });

		}


	});

	g2gApp.controller('guaranteeController', function(){

	});
	g2gApp.controller('myWarrantyController', function(){

	});
	g2gApp.controller('registerController', function(){

	});
	g2gApp.controller('loginController', function(){

	});
	g2gApp.controller('categoryController', function(){

	});
	g2gApp.controller('servicesController', function($scope) {});
	g2gApp.controller('aboutController', function($scope) {});
	g2gApp.controller('productListController', function($scope, $http, $routeParams){
		//获取产品分类
		$http.get(webRoot+'category-product').success(
		 function (data) {
		 	$scope.category = data.data;
			console.log($scope.category);
		 });

		$scope.products = [

			{pid:'signlighting', cid:'trico', img: 'channel_letter/trico.jpg', href: 'TriCo-Series.html'},
			{pid:'signlighting', cid:'aurora', img: 'channel_letter/aurora_i_gen_iv.jpg', href: 'Aurora-I-GenIV.html'},
			{pid:'signlighting', cid:'aurora', img: 'channel_letter/aurora_mini_red.jpg', href: 'Aurora-mini-red.html'},
			{pid:'signlighting', cid:'aurora', img: 'channel_letter/aurora_mini_white.jpg', href: 'Aurora-mini-white.html'},
			{pid:'signlighting', cid:'aurora', img: 'channel_letter/aurora_iii_gen_i.jpg', href: 'Aurora-III-GenI.html'},
			{pid:'signlighting', cid:'aurora', img: 'channel_letter/aurora_sv_white.jpg', href: 'Aurora-sv-white.html'},
			{pid:'signlighting', cid:'aurora', img: 'channel_letter/aurora_sv_red.jpg', href: 'Aurora-sv-red.html'},
			{pid:'signlighting', cid:'aurora', img: 'channel_letter/aurora_red.jpg', href: 'Aurora-red.html'},
			/*{pid:'signlighting', cid:'nox', img: 'channel_letter/nox.jpg', href: 'NOX-Series.html'},*/
			{pid:'signlighting', cid:'anpro', img: 'channel_letter/anpro.jpg', href: 'AnPro-Series.html'},
			{pid:'signlighting', cid:'wow', img: 'channel_letter/wow_white.jpg', href: 'WOW-Series.html'},
			{pid:'signlighting', cid:'wow', img: 'channel_letter/wow_red.jpg', href: 'WOW-Red.html'},
			{pid:'signlighting', cid:'anpro', img: 'channel_letter/anpro_180.jpg', href: 'anpro_pro.html'},
			

			{pid:'signlighting', cid:'side', img: 'sign_box/side.jpg', href: 'Side-Lighting-System.html'},
			{pid:'signlighting', cid:'array', img: 'sign_box/g2g_array.jpg', href: 'ArRay-Lighting-System.html'},
			/*{pid:'signlighting', cid:'sparx', img: 'sign_box/sparx.jpg', href: 'SparX-Lighting-System.html'},*/
			{pid:'signlighting', cid:'trident', img: 'sign_box/trident_df.jpg', href: 'Trident-DF.html'},
			{pid:'signlighting', cid:'trident', img: 'sign_box/trident_sf.jpg', href: 'Trident-SF.html'},
			{pid:'signlighting', cid:'trident-stick', img: 'sign_box/stick_df.jpg', href: 'trident_stick_df.html'},
			{pid:'signlighting', cid:'trident-stick', img: 'sign_box/stick_sf.jpg', href: 'trident_stick_sf.html'},
			{pid:'signlighting', cid:'trident-stick', img: 'sign_box/trident_premier_stick.jpg', href: 'trident_premier_stick.html'},
			{pid:'signlighting', cid:'arraybracket', img: 'accessories/arraybracket.jpg', href: 'arraybracket.html'},
			{pid:'signlighting', cid:'tridentbracket', img: 'accessories/tridentbracket.jpg', href: 'tridentbracket.html'},
			{pid:'signlighting', cid:'hosocket', img: 'accessories/hosocket.jpg', href: 'Ho_socket.html'},
			{pid:'signlighting', cid:'neon', img: 'neon/neon.jpg', href: 'neon.html'},
			{pid:'signlighting', cid:'anpro-stick', img: 'sign_box/anpro_180_stick_sf.jpg', href: 'anpro_stick_sf.html'},
			{pid:'signlighting', cid:'anpro-stick', img: 'sign_box/anpro_180_stick_df.jpg', href: 'anpro_stick_df.html'},

			{pid:'outdoorlighting', cid:'oona-slim', img: 'wall_washer/oona_slim.jpg', href: 'oona_slim_wall_washer.html'},
			{pid:'outdoorlighting', cid:'i_series', img: 'wall_washer/lww_1.jpg', href: 'Wall-Washer-I-Series.html'},
			{pid:'outdoorlighting', cid:'ii_series', img: 'wall_washer/lww_2.jpg', href: 'Wall-Washer-II-Series.html'},
			{pid:'outdoorlighting', cid:'v_series', img: 'wall_washer/lww_5.jpg', href: 'Wall-Washer-V-Series.html'},
			{pid:'outdoorlighting', cid:'vi_series', img: 'wall_washer/lww_6.jpg', href: 'Wall-Washer-Ⅵ-Series.html'},
			{pid:'outdoorlighting', cid:'vii_series', img: 'wall_washer/lww_7.jpg', href: 'Wall-Washer-Ⅶ-Series.html'},
			{pid:'outdoorlighting', cid:'viii_series', img: 'wall_washer/lww_8.jpg', href: 'Wall-Washer-Ⅷ-Series-LWW-8A-144P.html'},



			{pid:'outdoorlighting', cid:'i_series', img: 'flood_light/flood_10.jpg', href: 'Flood-Light-10W.html'},
			{pid:'outdoorlighting', cid:'ii_series', img: 'flood_light/flood_20.jpg', href: 'Flood-Light-20W.html'},
			{pid:'outdoorlighting', cid:'iii_series', img: 'flood_light/flood_30.jpg', href: 'Flood-Light-30W.html'},
			{pid:'outdoorlighting', cid:'v_series', img: 'flood_light/flood_50.jpg', href: 'Flood-Light-50W.html'},
			{pid:'outdoorlighting', cid:'vi_series', img: 'flood_light/flood_100.jpg', href: 'Flood-Light-100W.html'},

			{pid:'signlighting', cid:'wifi300', img: 'controller/wifi_300.jpg', href: 'Controllerwifi300.html'},
			{pid:'signlighting', cid:'diywifi', img: 'controller/diy_wifi.jpg', href: 'Controllerdiywifi.html'},
			{pid:'signlighting', cid:'rf3keys', img: 'controller/rf_3keys.jpg', href: 'ControllerRF3keys.html'},
			{pid:'signlighting', cid:'knod', img: 'controller/knob.jpg', href: 'ControllerKnod.html'},

		   /*{pid:'signlighting', cid:'100W', img: 'power/100W.jpg', href: 'power100W.html'},
			{pid:'signlighting', cid:'200W', img: 'power/200W.jpg', href: 'power200W.html'},
			{pid:'signlighting', cid:'300W', img: 'power/300W.jpg', href: 'power300W.html'},*/

			{pid:'outdoorlighting', cid:'40W', img: 'shoebox/shoebox_40.jpg', href: 'shoebox40W.html'},
			{pid:'outdoorlighting', cid:'80W', img: 'shoebox/shoebox_80.jpg', href: 'shoebox80W.html'},
			{pid:'outdoorlighting', cid:'120W', img: 'shoebox/shoebox_120.jpg', href: 'shoebox120W.html'},
			{pid:'outdoorlighting', cid:'160W', img: 'shoebox/shoebox_160.jpg', href: 'shoebox160W.html'},
			{pid:'outdoorlighting', cid:'200W', img: 'shoebox/shoebox_200.jpg', href: 'shoebox200W.html'},

			{pid:'outdoorlighting', cid:'105W', img: 'retrofit/retrofit_105.jpg', href: 'retrofit105W.html'},
			{pid:'outdoorlighting', cid:'120W', img: 'retrofit/retrofit_120.jpg', href: 'retrofit120W.html'},
			{pid:'outdoorlighting', cid:'150W', img: 'retrofit/retrofit_150.jpg', href: 'retrofit150W.html'},
			{pid:'outdoorlighting', cid:'200W', img: 'retrofit/retrofit_200.jpg', href: 'retrofit200W.html'},



			{pid:'commerciallighting', cid:'4ft', img: 'tube/tube_4ft.jpg', href: 'tube4ft.html'},
			{pid:'commerciallighting', cid:'6ft', img: 'tube/tube_6ft.jpg', href: 'tube6ft.html'},
			{pid:'commerciallighting', cid:'8ft', img: 'tube/tube_8ft.jpg', href: 'tube8ft.html'},


            /*calss2*/
			{pid:'letter', cid:'trico', img: 'channel_letter/trico.jpg', href: 'TriCo-Series.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora_i_gen_iv.jpg', href: 'Aurora-I-GenIV.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora_mini_red.jpg', href: 'Aurora-mini-red.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora_mini_white.jpg', href: 'Aurora-mini-white.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora_iii_gen_i.jpg', href: 'Aurora-III-GenI.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora_sv_white.jpg', href: 'Aurora-sv-white.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora_sv_red.jpg', href: 'Aurora-sv-red.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora_red.jpg', href: 'Aurora-red.html'},
			/*{pid:'letter', cid:'nox', img: 'channel_letter/nox.jpg', href: 'NOX-Series.html'},*/
			{pid:'letter', cid:'anpro', img: 'channel_letter/anpro.jpg', href: 'AnPro-Series.html'},
			{pid:'letter', cid:'anpro', img: 'channel_letter/anpro_180.jpg', href: 'anpro_pro.html'},
			{pid:'letter', cid:'wow', img: 'channel_letter/wow_white.jpg', href: 'WOW-Series.html'},
			{pid:'letter', cid:'wow', img: 'channel_letter/wow_red.jpg', href: 'WOW-Red.html'},

			{pid:'sign', cid:'side', img: 'sign_box/side.jpg', href: 'Side-Lighting-System.html'},
			{pid:'sign', cid:'array', img: 'sign_box/g2g_array.jpg', href: 'ArRay-Lighting-System.html'},
			/*{pid:'sign', cid:'sparx', img: 'sign_box/sparx.jpg', href: 'SparX-Lighting-System.html'},*/
			{pid:'sign', cid:'trident', img: 'sign_box/trident_df.jpg', href: 'Trident-DF.html'},
			{pid:'sign', cid:'trident', img: 'sign_box/trident_sf.jpg', href: 'Trident-SF.html'},
			{pid:'sign', cid:'trident-stick', img: 'sign_box/stick_df.jpg', href: 'trident_stick_df.html'},
			{pid:'sign', cid:'trident-stick', img: 'sign_box/stick_sf.jpg', href: 'trident_stick_sf.html'},
			{pid:'sign', cid:'trident-stick', img: 'sign_box/trident_premier_stick.jpg', href: 'trident_premier_stick.html'},
			{pid:'sign', cid:'anpro-stick', img: 'sign_box/anpro_180_stick_sf.jpg', href: 'anpro_stick_sf.html'},
			{pid:'sign', cid:'anpro-stick', img: 'sign_box/anpro_180_stick_df.jpg', href: 'anpro_stick_df.html'},
			
			{pid:'accessories', cid:'arraybracket', img: 'accessories/arraybracket.jpg', href: 'arraybracket.html'},
			{pid:'accessories', cid:'tridentbracket', img: 'accessories/tridentbracket.jpg', href: 'tridentbracket.html'},
			{pid:'accessories', cid:'hosocket', img: 'accessories/hosocket.jpg', href: 'Ho_socket.html'},
			
			{pid:'neon', cid:'neon', img: 'neon/neon.jpg', href: 'neon.html'},


			{pid:'wall', cid:'oona-slim', img: 'wall_washer/oona_slim.jpg', href: 'oona_slim_wall_washer.html'},
			{pid:'wall', cid:'i_series', img: 'wall_washer/lww_1.jpg', href: 'Wall-Washer-I-Series.html'},
			{pid:'wall', cid:'ii_series', img: 'wall_washer/lww_2.jpg', href: 'Wall-Washer-II-Series.html'},
			{pid:'wall', cid:'v_series', img: 'wall_washer/lww_5.jpg', href: 'Wall-Washer-V-Series.html'},
			{pid:'wall', cid:'vi_series', img: 'wall_washer/lww_6.jpg', href: 'Wall-Washer-Ⅵ-Series.html'},
			{pid:'wall', cid:'vii_series', img: 'wall_washer/lww_7.jpg', href: 'Wall-Washer-Ⅶ-Series.html'},
			{pid:'wall', cid:'viii_series', img: 'wall_washer/lww_8.jpg', href: 'Wall-Washer-Ⅷ-Series-LWW-8A-144P.html'},



			{pid:'flood', cid:'i_series', img: 'flood_light/flood_10.jpg', href: 'Flood-Light-10W.html'},
			{pid:'flood', cid:'ii_series', img: 'flood_light/flood_20.jpg', href: 'Flood-Light-20W.html'},
			{pid:'flood', cid:'iii_series', img: 'flood_light/flood_30.jpg', href: 'Flood-Light-30W.html'},
			{pid:'flood', cid:'v_series', img: 'flood_light/flood_50.jpg', href: 'Flood-Light-50W.html'},
			{pid:'flood', cid:'vi_series', img: 'flood_light/flood_100.jpg', href: 'Flood-Light-100W.html'},

			{pid:'controller', cid:'wifi300', img: 'controller/wifi_300.jpg', href: 'Controllerwifi300.html'},
			{pid:'controller', cid:'diywifi', img: 'controller/diy_wifi.jpg', href: 'Controllerdiywifi.html'},
			{pid:'controller', cid:'rf3keys', img: 'controller/rf_3keys.jpg', href: 'ControllerRF3keys.html'},
			{pid:'controller', cid:'knod', img: 'controller/knob.jpg', href: 'ControllerKnod.html'},

			{pid:'power', cid:'100W', img: 'power/power_100.jpg', href: 'power100W.html'},
			{pid:'power', cid:'200W', img: 'power/power_200.jpg', href: 'power200W.html'},
			{pid:'power', cid:'300W', img: 'power/power_300.jpg', href: 'power300W.html'},

			{pid:'shoebox', cid:'40W', img: 'shoebox/shoebox_40.jpg', href: 'shoebox40W.html'},
			{pid:'shoebox', cid:'80W', img: 'shoebox/shoebox_80.jpg', href: 'shoebox80W.html'},
			{pid:'shoebox', cid:'120W', img: 'shoebox/shoebox_120.jpg', href: 'shoebox120W.html'},
			{pid:'shoebox', cid:'160W', img: 'shoebox/shoebox_160.jpg', href: 'shoebox160W.html'},
			{pid:'shoebox', cid:'200W', img: 'shoebox/shoebox_200.jpg', href: 'shoebox200W.html'},

			{pid:'retrofit', cid:'105W', img: 'retrofit/retrofit_105.jpg', href: 'retrofit105W.html'},
			{pid:'retrofit', cid:'120W', img: 'retrofit/retrofit_120.jpg', href: 'retrofit120W.html'},
			{pid:'retrofit', cid:'150W', img: 'retrofit/retrofit_150.jpg', href: 'retrofit150W.html'},
			{pid:'retrofit', cid:'200W', img: 'retrofit/retrofit_200.jpg', href: 'retrofit200W.html'},

			{pid:'tube', cid:'4ft', img: 'tube/tube_4ft.jpg', href: 'tube4ft.html'},
			{pid:'tube', cid:'6ft', img: 'tube/tube_6ft.jpg', href: 'tube6ft.html'},
			{pid:'tube', cid:'8ft', img: 'tube/tube_8ft.jpg', href: 'tube8ft.html'},



		];

		$scope.pid = $routeParams.pid;
		$scope.cid = $routeParams.cid;
		$scope.flag = 1;

	    $scope.filtered = $scope.products.filter(function(item) {
			return item['pid'] == $scope.pid;
		});

		$scope.filterProducts = function(pid, cid) {
			    //赋值
				if(pid == 'signlighting') {
					$scope.flag=1;
				}
				else if(pid == 'outdoorlighting')
				{
					$scope.flag=2;
				}else if(pid == 'commerciallighting')
				{
					$scope.flag=3;
				}

	    		if(pid && !cid) {
	    			$scope.filtered = $scope.products.filter(function(item) {
		            return item['pid'] == pid;
		        });
	    		}
	    		else if(pid && cid)
	    		{
	    			$scope.filtered = $scope.products.filter(function(item) {
	            		return item['pid'] == pid && item['cid'] == cid;
	        		});
	    		}

	    		$scope.pid = pid;
			    $scope.cid = cid;

	    };
	});

	g2gApp.controller('productController', function($scope, $routeParams) {
		$scope.templateUrl = $routeParams.url;
	});

	g2gApp.controller('supportController', function($scope, $routeParams) {
		$scope.id = $routeParams.id;
		switch($scope.id)
		{
			case 'download':
				$scope.templateUrl = 'download.html';
				break;
			case 'news':
				$scope.templateUrl = 'News&Event.html';
				break;
			case 'contact':
				$scope.templateUrl = 'Contact-Us.html';
				break;
			case 'video':
				$scope.templateUrl = 'installation-video.html';
				break;
		}
	});


	g2gApp.run(function($http,$window,$rootScope){
		var user = JSON.parse($window.localStorage['user'] || '{}');
		$rootScope.user = user;

		if(user)
			$http.defaults.headers.common['Authorization'] = 'Basic ' + user.auth_key;
	});

	g2gApp.controller('mycenterController', function($scope,$rootScope, $http, $routeParams,$location,$window) {
		    $http.get(webRoot+'user/'+$routeParams.id).success(
		        function (data) {
		            $scope.userInfo = data.data;
	        });
		    $scope.logout = function()
				{

					$rootScope.user = '';

					delete $window.localStorage['user'];

					$location.path('/').replace();
					$http.get(webRoot+'user/loguot').success(
			        function (data) {

			        });
				}
		    $scope.cart = new Array();
		    //选项卡切换
		    $scope.tabs = [{
		            title: 'My information',
		            url: 'myInfo'
		        }, {
		            title: 'My Warranty',
		            url: 'myWarranty'
		        }, {
		            title: 'Add New Labor',
		            url: 'newLabor'
		    }];

		    $scope.currentTab = 'myInfo';
		    $scope.mydate = {};
		    $scope.onClickTab = function (tab) {
		        $scope.currentTab = tab.url;
		        $http.get(webRoot+'guarantee').success(
		        function (data) {
					$scope.cart = data.data;

					$scope.cart.forEach(function(value,index){
						var dateStr = new Date(value.completion_date * 1000);
						value.completion_date = dateStr.getMonth()+1 +'-' + dateStr.getDate()+ '-' +dateStr.getFullYear();
					});
	        });

		    }

		    $scope.isActiveTab = function(tabUrl) {
		        return tabUrl == $scope.currentTab;
		    }
		    //质保信息列表

		    //获取产品分类
		   /* $http.get(webRoot+'category-product').success(
		        function (data) {
		            $scope.category =JSON.stringify(data.data);



	        });
	        */
		     $scope.division = {
		     	"channel letter modules": {
		     	                   "Aurora Series":[
		     	                                    "Aurora I Gen IV",
		     	                                    "Aurora III Gen I",
									                "Aurora Red",
		     	                                    "Aurora SV 7500K",
									                "Aurora SV Red",
		     	                                    "Aurora MINI White",
		     	                                    "Aurora MiNI Red"
		     	                   ],
		     	                   "Anpro Series":[
		     	                                    "Anpro 7500K",
									                "Anpro 6300K"
		     	                   ],
		     	                   "WOW Series":[
		     	                                    "WOW White",
		     	                                    "WOW Red"
		     	                   ],
		     	                   "TriCo Series":[
		     	                                    "TriCo"
		     	                   ],
		     	                   "Nox Series":[
		     	                                    "Nox white"
		     	                   ]
		     	},
		     	"Sign Cabinet modules": {
		     	                   "ArRay":[
		     	                                    "ArRay Pro 3.6W",
		     	                                    "ArRay ECO 1.8W",
									                 "ArRay SF 1.0W"
		     	                   ],
		     	                   "Trident":[
		     	                                    "Trident DF",
		     	                                    "Trident SF",
									                "Trident SF(NL)"
		     	                   ],
		     	                   "Trident DF Stick":[
		     	                                    "Trident DF Stick 1FT",
		     	                                    "Trident DF Stick 18IN",
		     	                                    "Trident DF Stick 42IN",
									                "Trident DF Stick 64IN",
									                "Trident DF Stick 2FT",
									                "Trident DF Stick 4FT",
									                "Trident DF Stick 6FT",
									                "Trident DF Stick 8FT",
									                "Trident DF Stick 10FT"

		     	                   ],
		     	                   "Trident SF Stick":[
		     	                                    "Trident SF Stick 1FT",
		     	                                    "Trident SF Stick 18IN",
		     	                                    "Trident SF Stick 42IN",
									                "Trident SF Stick 64IN",
									                "Trident SF Stick 2FT",
									                "Trident SF Stick 4FT",
									                "Trident SF Stick 6FT",
									                "Trident SF Stick 8FT",
		     	                                    "Trident SF Stick 10FT"
		     	                   ],
		     	                   "SiDe":[
		     	                                    "SiDe"
		     	                   ]

		      },
		     "LED Wall Washer" : {
		     	                   "1 Series":[
		     	                                    "LWW-1C-36P"

		     	                   ],
		     	                   "2 Series":[
		     	                                    "LWW-2-36P",
		     	                                    "LWW-2-72P",
		     	                                    "LWW-2-144P"
		     	                   ],
		     	                   "5 Series":[
		     	                                    "LWW-5-18P-L500",
		     	                                    "LWW-5-36P-L1000",
		     	                                    "LWW-5-36P-L1200"
		     	                   ],
		     	                   "6 Series":[
		     	                                    "LWW-6-18P",
		     	                                    "LWW-6-36P"

		     	                   ],
		     	                   "7 Series":[
		     	                                    "LWW-7-36P",
		     	                                    "LWW-7-72P"
		     	                   ],
									 "Oona slim wall washer":[
										 "Oona slim washer blue",
										 "Oona slim washer green",
										 "Oona slim washer red",
										 "Oona slim washer white",
										 "Oona slim washer amber"
									 ]
                },
				 "Controller": {
									 "RGB Controller":[
										 "WIFI-300",
										 "DIY-WIFI"

									 ],
									 "Dimmer Controller":[
										 "Manual Adjusting Knob",
										 "RF-3 Keys",
										 "Amplifier"
									 ]
				 },
				 "Power Supplies": {
					 "Module Power Supplies":[
						 "12VDC 100W",
						 "12VDC 200W",
						 "12VDC 320W",
						 "24VDC 100W"

					 ]
				 },
				 "Flood Light": {
					 "Module Power Supplies":[
						 "12VDC 100W",
						 "12VDC 200W",
						 "12VDC 320W",
						 "24VDC 100W"

					 ]
				 }
		     }
		     $scope.optionDistributor = [
		                            {"distributor" : "poineer"},
		                            {"distributor" : "wensco"},
		                            {"distributor" : "denco"}
		     ];
		     //日期控件
		      $scope.today = function() {
			    $scope.dt = new Date();
			  };
			  $scope.today();

			  $scope.clear = function() {
			    $scope.dt = null;
			  };

			  $scope.inlineOptions = {
			    customClass: getDayClass,
			    minDate: new Date(),
			    showWeeks: true
			  };

			  $scope.dateOptions = {
			    //dateDisabled: disabled,
			    formatYear: 'yy',
			    maxDate: new Date(),
			    minDate: new Date(),
			    startingDay: 1
			  };

			  // Disable weekend selection
			  function disabled(data) {
			    var date = data.date,
			      mode = data.mode;
			    return mode === 'day' && (date.getDay() === 0 || date.getDay() === 5);
			  }

			  $scope.toggleMin = function() {
			    $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
			    $scope.dateOptions.minDate = $scope.inlineOptions.minDate;
			  };

			  $scope.toggleMin();

			  $scope.open1 = function() {
			    $scope.popup1.opened = true;
			  };

			  $scope.open2 = function() {
			    $scope.popup2.opened = true;
			  };

			  $scope.setDate = function(year, month, day) {
			    $scope.dt = new Date(year, month, day);
			  };

			  $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
			  $scope.format = $scope.formats[0];
			  $scope.altInputFormats = ['M!/d!/yyyy'];

			  $scope.popup1 = {
			    opened: false
			  };

			  $scope.popup2 = {
			    opened: false
			  };

			  var tomorrow = new Date();
			  tomorrow.setDate(tomorrow.getDate() + 1);
			  var afterTomorrow = new Date();
			  afterTomorrow.setDate(tomorrow.getDate() + 1);
			  $scope.events = [
			    {
			      date: tomorrow,
			      status: 'full'
			    },
			    {
			      date: afterTomorrow,
			      status: 'partially'
			    }
			  ];

			  function getDayClass(data) {
			    var date = data.date,
			      mode = data.mode;
			    if (mode === 'day') {
			      var dayToCheck = new Date(date).setHours(0,0,0,0);

			      for (var i = 0; i < $scope.events.length; i++) {
			        var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

			        if (dayToCheck === currentDay) {
			          return $scope.events[i].status;
			        }
			      }
			    }

			    return '';
			  }
			  $scope.warrantyInfo = {};
			  
			  $scope.addLabor = function(){
				  var fd = new FormData();
			        var file = document.querySelector('input[type=file]').files[0];
			        fd.append('files', file); 
			        angular.forEach($scope.warrantyInfo, function (v,k) {
			        	fd.append(k, v); 
                	});
				  $http({
		              method:'POST',
		              url:webRoot+'guarantee',
		              data: fd,
		              headers: {'Content-Type':undefined},
		          }); 
				  
                     /*$http.post(webRoot+'guarantee', $scope.warrantyInfo).success(
		                function (data) {

		                	if(data.success == true)
		                	{

		                	}
		                	else
		                	{
		                		angular.forEach(data.data, function (error) {
		                            $scope.error = error.message;
		                    	});
		                	}
		            });*/

			 }
		});

	/*g2gApp.directive('customOnChange', function() {
		  return {
		    restrict: 'A',
		    link: function (scope, element, attrs) {
		      var onChangeHandler = scope.$eval(attrs.customOnChange);
		      element.bind('change', onChangeHandler);
		    }
		  };
		});*/
	
})(window.angular);
