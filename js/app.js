(function(angular) {
	'use strict';
	var g2gApp = angular.module('g2gApp', ['ngAnimate', 'ngRoute', 'ui.bootstrap']);
	var webRoot = '/g2g-website/api/web/';
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
		.when('/mycenter', {
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
						console.log(1);
                		$('#signupModal').hide();
                		angular.element(".modal-backdrop").removeClass('modal-backdrop', 'fade', 'in');
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
                		$http.defaults.headers.common['Authorization'] = 'Basic ' + $scope.user.auth_key;
                		$('#loginModal').hide();
                		angular.element(".modal-backdrop").removeClass('modal-backdrop', 'fade', 'in');
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
	g2gApp.controller('productListController', function($scope, $routeParams){
		$scope.products = [
			{pid:'letter', cid:'trico', img: 'channel_letter/TriCo.jpg', href: 'TriCo-Series.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora-i-gen-iv.jpg', href: 'Aurora-I-GenIV.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora-mini.jpg', href: 'Aurora-mini.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora-iii-gen-i.jpg', href: 'Aurora-III-GenI.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora-sv-ii.jpg', href: 'Aurora-sv.html'},
			{pid:'letter', cid:'aurora', img: 'channel_letter/aurora-r.jpg', href: 'Aurora-red.html'},
			{pid:'letter', cid:'nox', img: 'channel_letter/g2g-nox.jpg', href: 'NOX-Series.html'},
			{pid:'letter', cid:'anpro', img: 'channel_letter/g2g-anpro.jpg', href: 'AnPro-Series.html'},
			{pid:'letter', cid:'wow', img: 'channel_letter/g2g-wow.jpg', href: 'WOW-Series.html'},
			{pid:'letter', cid:'wow', img: 'channel_letter/g2g-wow-red.jpg', href: 'WOW-Red.html'},

			{pid:'sign', cid:'side', img: 'sign_box/SiDe.jpg', href: 'Side-Lighting-System.html'},
			{pid:'sign', cid:'array', img: 'sign_box/Array.jpg', href: 'ArRay-Lighting-System.html'},
			{pid:'sign', cid:'sparx', img: 'sign_box/Spart_X.jpg', href: 'SparX-Lighting-System.html'},
			{pid:'sign', cid:'trident', img: 'sign_box/Trident_DF.jpg', href: 'Trident-Lighting-System.html'},
			{pid:'sign', cid:'trident', img: 'sign_box/Trident_SF.jpg', href: 'Trident-Lighting-System.html'},
			{pid:'sign', cid:'trident-stick', img: 'sign_box/Trident-stick.jpg', href: 'Trident-Stick-Lighting-System.html'},

			{pid:'wall', cid:'i_series', img: 'wall_washer/lww-1c-36p.jpg', href: 'Wall-Washer-I-Series.html'},
			{pid:'wall', cid:'ii_series', img: 'wall_washer/lww-2-36p-72p-144p.jpg', href: 'Wall-Washer-II-Series.html'},
			{pid:'wall', cid:'v_series', img: 'wall_washer/lww-5-18p-36p.jpg', href: 'Wall-Washer-V-Series.html'},
			{pid:'wall', cid:'vi_series', img: 'wall_washer/lww-6-18p-36p.jpg', href: 'Wall-Washer-Ⅵ-Series.html'},
			{pid:'wall', cid:'vii_series', img: 'wall_washer/lww-7-36p-72p.jpg', href: 'Wall-Washer-Ⅶ-Series.html'},
			{pid:'wall', cid:'viii_series', img: 'wall_washer/lww-8a-144p.jpg', href: 'Wall-Washer-Ⅷ-Series-LWW-8A-144P.html'},
			{pid:'wall', cid:'viii_series', img: 'wall_washer/lww-8b-108p.jpg', href: 'Wall-Washer-Ⅷ-Series-LWW-8B-108P.html'},
			{pid:'wall', cid:'viii_series', img: 'wall_washer/lww-8c-108p-216p.jpg', href: 'Wall-Washer-Ⅷ-Series-LWW-8C-108P216P.html'},

			{pid:'flood', cid:'i_series', img: 'Flood_light/10W.jpg', href: 'Flood-Light-I-Series.html'},
			{pid:'flood', cid:'ii_series', img: 'Flood_light/20W.jpg', href: 'Flood-Light-II-Series.html'},
			{pid:'flood', cid:'iii_series', img: 'Flood_light/30W.jpg', href: 'Flood-Light-III-Series.html'},
			{pid:'flood', cid:'v_series', img: 'Flood_light/50W.jpg', href: 'Flood-Light-V-Series.html'},



		];

		$scope.pid = $routeParams.pid;
		$scope.cid = $routeParams.cid;

	    $scope.filtered = $scope.products.filter(function(item) {
			return item['pid'] == $scope.pid;
		});

		$scope.filterProducts = function(pid, cid) {
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

	/*g2gApp.controller('usercenterController', function($scope,$rootScope, $http, $routeParams,$location,$window){
		$http.get(webRoot+'user/'+$routeParams.id).success(
        function (data) {
            $scope.userInfo = data.data;
        });
        $scope.guarantee = function()
        {
        	$http.get(webRoot+'guarantee').success(
	        function (data) {
	            $scope.guarantee = data.data;
	            console.log($scope.guarantee);
	        });
        }
        $scope.loguot = function()
		{
			$rootScope.user = '';
			delete $window.localStorage['user'];
			$location.path('/').replace();
			$http.get(webRoot+'user/loguot').success(
	        function (data) {
	        });
		}
		$scope.guaranteeAdd = function(){
			angular.element("#not-guarantee").css('display', 'none');
			$scope.viewadd = 'views/guarantee/add.html';
		}
	});*/
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

		    $scope.onClickTab = function (tab) {
		        $scope.currentTab = tab.url;
		        $http.get(webRoot+'guarantee').success(
		        function (data) {
		            console.log(data);
	        });

		    }

		    $scope.isActiveTab = function(tabUrl) {
		        return tabUrl == $scope.currentTab;
		    }
		    //质保信息列表
		    $scope.cart = new Array();
		    //获取产品分类
		    $http.get(webRoot+'category-product').success(
		        function (data) {
		            $scope.category = data.data;

	        });
		     $scope.division = {
		     	"Channel letter": {
		     	                   "Aurora Series":[
		     	                                    "Aurora I Gen IV",
		     	                                    "Aurora III Gen I",
		     	                                    "Aurora SV II",
		     	                                    "Aurora MINI",
		     	                                    "Aurora Red"
		     	                   ],
		     	                   "Anpro Series":[
		     	                                    "anpro"
		     	                   ],
		     	                   "WOW Series":[
		     	                                    "WOW White",
		     	                                    "WOW Red"
		     	                   ],
		     	                   "TriCo Series":[
		     	                                    "TriCo"
		     	                   ],
		     	                   "Nox Series":[
		     	                                    "Nox"
		     	                   ]
		     	},
		     	"sign Box": {
		     	                   "ArRay":[
		     	                                    "ArRay PRO DF",
		     	                                    "ArRay ECO DF"
		     	                   ],
		     	                   "Trident":[
		     	                                    "Trident DF",
		     	                                    "Trident SF"
		     	                   ],
		     	                   "Trident DF Stick":[
		     	                                    "Trident DF Stick 4FT",
		     	                                    "Trident DF Stick 6FT",
		     	                                    "Trident DF Stick 8FT",
		     	                                    "Trident DF Stick 10FT"
		     	                   ],
		     	                   "Trident SF Stick":[
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
		     	                   "8 Series":[
		     	                                    "LWW-8C-108P",
		     	                                    "LWW-8C-216P"
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
			    maxDate: new Date(2020, 5, 22),
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
                     $http.post(webRoot+'guarantee', $scope.warrantyInfo).success(
		                function (data) {

		                	if(data.success == true)
		                	{
		                		 $scope.cart.push($scope.warrantyInfo);
		                	}
		                	else
		                	{
		                		angular.forEach(data.data, function (error) {
		                            $scope.error = error.message;
		                    	});
		                	}
		            });

			 }
		});


})(window.angular);