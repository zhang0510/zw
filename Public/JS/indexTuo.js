$.ajaxSetup({
  async: false
  });
function getCity(pid,sign,name){
		$.post('/Front/Index/getCity',{'pid':pid},function(data){
			var num = data.length;
			var str = '';
			console.log(data);
			for(var i=0;i<num;i++){
				if(sign=='S'){
					str += '<li onclick="getBlock(\''+data[i]['area_id']+'\',\'S\',\''+data[i]['area_name']+'\');">'+data[i]['area_name']+'</li>';
				}
				if(sign=='E'){
					str += '<li onclick="closeF(\''+data[i]['area_id']+'\',\'E\',\''+data[i]['area_name']+'\');">'+data[i]['area_name']+'</li>';
				}
			}
			if(sign=='S'){
				$("#qsp").hide();
				$("#qsre").val('');
				$("#qsrc").val('');
				$("#spro").val('');
				$("#maoli").val(0);
				$("#tprice").val(0);
				$("#total").val(0);
				$("#ti").val(0);
				$("#sans").val('');
				$("#feesan").val(0);
				$("#tid").val('');
				$("#eprice").val(0);
				$("#qsre").val(pid);
				$("#qsrc").val(name);
				$("#qsc li").empty();
				$("#qsc").append(str);
				$("#qsc").show();
			}
			if(sign=='E'){
				$("#qep").hide();
				$("#qere").val('');
				$("#qerc").val('');
				$("#epro").val('');
				$("#maoli").val(0);
				$("#tprice").val(0);
				$("#total").val(0);
				$("#song").val(0);
				$("#sane").val('');
				$("#feesan").val(0);
				$("#sid").val('');
				$("#eprice").val(0);
				$("#qere").val(pid);
				$("#qerc").val(name);
				$("#qec li").empty();
				$("#qec").append(str);
				$("#qec").show();
			}
		});
	}
	function getBlock(pid,sign,name){
		$.post('/Front/Index/getBlock',{'pid':pid},function(data){
			var num = data.length;
			var str = '';
			for(var i=0;i<num;i++){
				if(sign=='S'){
					str += '<li onclick="closeF(\''+data[i]['area_id']+'\',\'S\',\''+data[i]['area_name']+'\');">'+data[i]['area_name']+'</li>';
				}
			}
			if(sign=='S'){
				$("#qsc").hide();
				var old = $("#qsre").val();
				var olds = $("#qsrc").val();
				var ne = old+','+pid;
				$("#tid").val(ne);
				var nes = olds+'-'+name;
				$("#qsre").val(ne);
				$("#qsrc").val(nes);
				$("#qsb li").empty();
				$("#qsb").append(str);
				$("#qsb").show();
			}
			if(sign=='E'){
				$("#qec").hide();
				var old = $("#qere").val();
				var olds = $("#qerc").val();
				var ne = old+','+pid;
				var nes = olds+'-'+name;
				$("#qere").val(ne);
				$("#qerc").val(nes);
				$("#qeb li").empty();
				$("#qeb").append(str);
				$("#qeb").show();
			}
		})
	}
	function closeF(pid,sign,name){
		if(sign=='S'){
			$("#qsb").hide();
			var old = $("#qsre").val();
			var olds = $("#qsrc").val();
			var ne = old+','+pid;
			var nes = olds+'-'+name;
			$.post('/Front/Index/getTi',{'start':ne},function(data){
				if(data!=''&&data!=null){
					$("#ti").val(parseInt(data['ti_platelets_price'])/100);
					$("#sans").val(data['ti_end']);
					$("#spro").val(data['spro']);
					var epro = $("#epro").val();
					$.post('/Front/Index/getMaoli',{'spro':data['spro'],'epro':epro},function(data){
						if(data!=''&&data!=null){
							$("#maoli").val(data);
						}else{
							$("#maoli").val(0);
						}
					});
				}else{
					$("#ti").val(0);
					$("#sans").val(0);
					$("#spro").val(0);
					$("#maoli").val(0);
				}
			})
			$("#qsre").val(ne);
			$("#qsrc").val(nes);
			$("#qsp").show();
			var sans = $("#sans").val();
			var sane = $("#sane").val();
			if(sans!=''&&sane!=''){
				$.post('/Front/Index/getSan',{'start':sans,'end':sane},function(data){
					if(data!=''&&data!=null){
						$("#feesan").val(parseInt(data['san_price'])/100);
					}else{
						$("#feesan").val(0);
					}
				})
			}else{
				$("#feesan").val(0);
			}
			var san = $("#feesan").val();
			var ti = $("#ti").val();
			var song = $("#song").val();
			var tprices = parseInt(san)+parseInt(ti)+parseInt(song);
			$("#tprice").val(tprices);
			var sprice = $("#sprice").val();
			var eprice = $("#eprice").val();
			var maoli = $("#maoli").val();
			var tprice = tprices + parseInt(eprice)/100 + parseInt(maoli)/100;
			$("#trans").html(tprice);
			var total = tprice + parseInt(sprice);
			$("#zong").html(total);
			$("#total").val(total);
			var olden = $("#qere").val();
			$("#q1").hide();
		}
		if(sign=='E'){
			$("#qec").hide();
			var old = $("#qere").val();
			var olds = $("#qerc").val();
			var ne = old+','+pid;
			$("#sid").val(ne);
			$.post('/Front/Index/getSong',{'end':ne},function(data){
				if(data!=''&&data!=null){
					$("#song").val(parseInt(data['song_platelets_price'])/100);
					$("#sane").val(data['song_star']);
					$("#epro").val(data['epro']);
					var spro = $("#spro").val();
					$.post('/Front/Index/getMaoli',{'spro':spro,'epro':data['epro']},function(data){
						if(data!=''&&data!=null){
							$("#maoli").val(data);
						}else{
							$("#maoli").val(0);
						}
					});
				}else{
					$("#song").val(0);
					$("#sane").val(0);
					$("#maoli").val(0);
					$("#epro").val(0);
				}
			})
			var sans = $("#sans").val();
			var sane = $("#sane").val();
			if(sans!=''&&sane!=''){
				$.post('/Front/Index/getSan',{'start':sans,'end':sane},function(data){
					if(data!=''&&data!=null){
						$("#feesan").val(parseInt(data['san_price'])/100);
					}else{
						$("#feesan").val(0);
					}
				})
			}else{
				$("#feesan").val(0);
			}
			var nes = olds+'-'+name;
			$("#qere").val(ne);
			$("#qerc").val(nes);
			$("#qep").show();
			var olden = $("#qsre").val();
			var san = $("#feesan").val();
			var ti = $("#ti").val();
			var song = $("#song").val();
			var tprices = parseInt(san)+parseInt(ti)+parseInt(song);
			$("#tprice").val(tprices);
			var sprice = $("#sprice").val();
			var maoli = $("#maoli").val();
			var eprice = $("#eprice").val();
			var tprice = tprices + parseInt(eprice)/100 + parseInt(maoli)/100;
			$("#trans").html(tprice);
			var total = tprice + parseInt(sprice);
			$("#zong").html(total);
			$("#total").val(total);
			$("#q2").hide();
		}
	}
	
	function getType(pid,name){
		$("#qbt").html('');
		$("#qscte").val('');
		$("#eprice").val(0);
		$("#qt li").empty();
		$.post('/Front/Index/getType',{'pid':pid},function(data){
			var num = data.length;
			var str = '';
			for(var i=0;i<num;i++){
				str += '<li onclick="closeFF(\''+data[i]['cxjj_id']+'\',\''+data[i]['cxjj_brand']+'\',\''+data[i]['cxjj_price']+'\');">'+data[i]['cxjj_brand']+'</li>';
			}
			$('#qt').append(str);
			$("#qbr").hide();
			$("#qt").show();
			$("#qbt").val(name);
			$("#qscte").val(name);
		})
	}
	function closeFF(pid,name,price){
		$("#qsctc").val('');
		$("#qt").hide();
		$("#qbr").show();
		$("#qsctc").val(name);
		var brand = $("#qscte").val();
		var brandType = brand +'-'+ name;
		$("#qbt").val(brandType);
		var trans = $("#tprice").val();
		var secu = $("#sprice").val();
		var maoli = $("#maoli").val();
		var totalt = parseInt(trans) + price/100 + parseInt(maoli)/100;
		$("#eprice").val(price);
		$("#trans").html(totalt);
		var total = parseInt(trans) + price/100 + parseInt(secu) + parseInt(maoli)/100;
		$("#zong").html(total);
		$("#total").val(total);
		$("#q3").hide();
		//关闭
	}
	function checksecu(obj){
		var price = $(obj).val();
		if(price == ''){
			return false;
		}
		var price = parseInt(price)*10000;
		var z = /^[1-9]\d*$/;
		if(z.test(price)){
			$.post('/Front/Index/getSecu',{'price':price},function(data){
				if(data!=''&&data!=null){
					$("#sprice").val(data);
					$("#secu").html(data);
					var eprice = $("#eprice").val();
					var maoli = $("#maoli").val();
					var tprice = $("#tprice").val();
					var total = parseInt(eprice)/100 + parseInt(tprice) + parseInt(data) + parseInt(maoli)/100;
					$("#zong").html(total);
					$("#total").val(total);
				}else{
					$("#sprice").val(0);
					$("#secu").html(0);
					var eprice = $("#eprice").val();
					var maoli = $("#maoli").val();
					var tprice = $("#tprice").val();
					var total = parseInt(eprice)/100 + parseInt(tprice) + parseInt(data) + parseInt(maoli);
					$("#zong").html(total);
					$("#total").val(total);
				}
			})
		}else{
			return false;
		}
	}
	function qshop(){
		var qphone = $("#qphone").val();
		var qname = $("#qname").val();
		var qcarprice = parseFloat($("#qcarprice").val());
		var qstart = $("#qsre").val();
		var qend = $("#qere").val();
		var qbrand = $("#qscte").val();
		var qtype = $("#qsctc").val();
		var tprice = $("#tprice").val();
		var eprice = $("#eprice").val();
		var sprice = $("#sprice").val();
		var maoli = $("#maoli").val();
		if(qstart==''||qend==''||qbrand==''||qtype==''||tprice==''||eprice==''||sprice==''||maoli==''){
			$.anewAlert('请完整录入信息');
			return false;
		}
		if(!$.check_Mobile(qphone)){
			$.anewAlert('请输入正确的手机号');
			return false;
		}
		if(qname==''){
			$.anewAlert('请输入姓名');
			return false;
		}
		if(isNaN(qcarprice)){
			$.anewAlert('请输入车辆价格');
			return false;
		}
		$("#quick").submit();
	}
//正常下单	
	
	
	function getCityz(pid,sign,name){
		$.post('/Front/Index/getCity',{'pid':pid},function(data){
			var num = data.length;
			var str = '';
			for(var i=0;i<num;i++){
				if(sign=='S'){
					str += '<li onclick="getBlockz(\''+data[i]['area_id']+'\',\'S\',\''+data[i]['area_name']+'\');">'+data[i]['area_name']+'</li>';
				}
				if(sign=='E'){
					str += '<li onclick="closeFz(\''+data[i]['area_id']+'\',\'E\',\''+data[i]['area_name']+'\');">'+data[i]['area_name']+'</li>';
				}
			}
			if(sign=='S'){
				$("#qspz").hide();
				$("#qsrez").val('');
				$("#qsrcz").val('');
				$("#sproz").val('');
				$("#maoliz").val(0);
				$("#tpricez").val(0);
				$("#totalz").val(0);
				$("#tiz").val(0);
				$("#sansz").val('');
				$("#feesanz").val(0);
				$("#tidz").val('');
				$("#epricez").val(0);
				$("#qsrez").val(pid);
				$("#qsrcz").val(name);
				$("#qscz li").empty();
				$("#qscz").append(str);
				$("#qscz").show();
			}
			if(sign=='E'){
				$("#qepz").hide();
				$("#qerez").val('');
				$("#qercz").val('');
				$("#eproz").val('');
				$("#maoliz").val(0);
				$("#tpricez").val(0);
				$("#totalz").val(0);
				$("#songz").val(0);
				$("#sanez").val('');
				$("#feesanz").val(0);
				$("#sidz").val('');
				$("#epricez").val(0);
				$("#qerez").val(pid);
				$("#qercz").val(name);
				$("#qecz li").empty();
				$("#qecz").append(str);
				$("#qecz").show();
			}
		});
	}
	function getBlockz(pid,sign,name){
		$.post('/Front/Index/getBlock',{'pid':pid},function(data){
			var num = data.length;
			var str = '';
			for(var i=0;i<num;i++){
				if(sign=='S'){
					str += '<li onclick="closeFz(\''+data[i]['area_id']+'\',\'S\',\''+data[i]['area_name']+'\');">'+data[i]['area_name']+'</li>';
				}
			}
			if(sign=='S'){
				$("#qscz").hide();
				var old = $("#qsrez").val();
				var olds = $("#qsrcz").val();
				var ne = old+','+pid;
				$("#tidz").val(ne);
				var nes = olds+'-'+name;
				$("#qsrez").val(ne);
				$("#qsrcz").val(nes);
				$("#qsbz li").empty();
				$("#qsbz").append(str);
				$("#qsbz").show();
			}
			if(sign=='E'){
				$("#qecz").hide();
				var old = $("#qerez").val();
				var olds = $("#qercz").val();
				var ne = old+','+pid;
				var nes = olds+'-'+name;
				$("#qerez").val(ne);
				$("#qercz").val(nes);
				$("#qebz li").empty();
				$("#qebz").append(str);
				$("#qebz").show();
			}
		})
	}
	function closeFz(pid,sign,name){
		if(sign=='S'){
			$("#qsbz").hide();
			var old = $("#qsrez").val();
			var olds = $("#qsrcz").val();
			var ne = old+','+pid;
			var nes = olds+'-'+name;
			$("#tidz").val(ne);
			$.post('/Front/Index/getTi',{'start':ne},function(data){
				if(data!=''&&data!=null){
					$("#tiz").val(parseInt(data['ti_platelets_price'])/100);
					$("#sansz").val(data['ti_end']);
					$("#sproz").val(data['spro']);
					var epro = $("#eproz").val();
					$.post('/Front/Index/getMaoli',{'spro':data['spro'],'epro':epro},function(data){
						if(data!=''&&data!=null){
							$("#maoliz").val(data);
						}else{
							$("#maoliz").val(0);
						}
					});
				}else{
					$("#tiz").val(0);
					$("#sansz").val(0);
					$("#maoliz").val(0);
				}
			})
			$("#qsrez").val(ne);
			$("#qsrcz").val(nes);
			$("#qspz").show();
			var sans = $("#sansz").val();
			var sane = $("#sanez").val();
			if(sans!=''&&sane!=''){
				$.post('/Front/Index/getSan',{'start':sans,'end':sane},function(data){
					if(data!=''&&data!=null){
						$("#feesanz").val(parseInt(data['san_price'])/100);
					}else{
						$("#feesanz").val(0);
					}
				})
			}else{
				$("#feesanz").val(0);
			}
			var san = $("#feesanz").val();
			var ti = $("#tiz").val();
			var song = $("#songz").val();
			var tprices = parseInt(san)+parseInt(ti)+parseInt(song);
			$("#tpricez").val(tprices);
			var sprice = $("#spricez").val();
			var eprice = $("#epricez").val();
			var maoli = $("#maoliz").val();
			var tprice = tprices + parseInt(eprice)/100 + parseInt(maoli)/100;
			$("#zongz").html(tprice);
			$("#totalz").val(tprice);
			var olden = $("#qerez").val();
			$("#q4").hide();
		}
		if(sign=='E'){
			$("#qecz").hide();
			var old = $("#qerez").val();
			var olds = $("#qercz").val();
			var ne = old+','+pid;
			$("#sidz").val(ne);
			$.post('/Front/Index/getSong',{'end':ne},function(data){
				if(data!=''&&data!=null){
					$("#songz").val(parseInt(data['song_platelets_price'])/100);
					$("#sanez").val(data['song_star']);
					$("#eproz").val(data['epro']);
					var spro = $("#sproz").val();
					$.post('/Front/Index/getMaoli',{'spro':spro,'epro':data['epro']},function(data){
						if(data!=''&&data!=null){
							$("#maoliz").val(data);
						}else{
							$("#maoliz").val(0);
						}
					});
				}else{
					$("#songz").val(0);
					$("#sanez").val(0);
					$("#maoliz").val(0);
				}
			})
			var sans = $("#sansz").val();
			var sane = $("#sanez").val();
			if(sans!=''&&sane!=''){
				$.post('/Front/Index/getSan',{'start':sans,'end':sane},function(data){
					if(data!=''&&data!=null){
						$("#feesanz").val(parseInt(data['san_price'])/100);
					}else{
						$("#feesanz").val(0);
					}
				})
			}else{
				$("#feesanz").val(0);
			}
			var nes = olds+'-'+name;
			$("#qerez").val(ne);
			$("#qercz").val(nes);
			$("#qepz").show();
			var olden = $("#qsrez").val();
			var san = $("#feesanz").val();
			var ti = $("#tiz").val();
			var song = $("#songz").val();
			var tprices = parseInt(san)+parseInt(ti)+parseInt(song);
			$("#tpricez").val(tprices);
			var maoli = $("#maoliz").val();
			var eprice = $("#epricez").val();
			var tprice = tprices + parseInt(eprice)/100 + parseInt(maoli)/100;
			$("#zongz").html(tprice);
			$("#totalz").val(tprice);
			$("#q5").hide();
		}
	}
	
	function getTypez(pid,name){
		$("#qbtz").html('');
		$("#qsctez").val('');
		$("#epricez").val(0);
		$("#qtz li").empty();
		$.post('/Front/Index/getType',{'pid':pid},function(data){
			var num = data.length;
			var str = '';
			for(var i=0;i<num;i++){
				str += '<li onclick="closeFFz(\''+data[i]['cxjj_id']+'\',\''+data[i]['cxjj_brand']+'\',\''+data[i]['cxjj_price']+'\');">'+data[i]['cxjj_brand']+'</li>';
			}
			$('#qtz').append(str);
			$("#qbrz").hide();
			$("#qtz").show();
			$("#qbtz").val(name);
			$("#qsctez").val(name);
		})
	}
	function closeFFz(pid,name,price){
		$("#qsctcz").val('');
		$("#qtz").hide();
		$("#qbrz").show();
		$("#qsctcz").val(name);
		var brand = $("#qsctez").val();
		var brandType = brand +'-'+ name;
		$("#qbtz").val(brandType);
		var trans = $("#tpricez").val();
		var maoli = $("#maoliz").val();
		var totalt = parseInt(trans) + price/100 + parseInt(maoli)/100;
		$("#epricez").val(price);
		$("#zongz").html(totalt);
		$("#totalz").val(totalt);
		$("#q6").hide();
		//关闭
	}
	
	function goOrder(){
		var qstart = $("#qsrez").val();
		var qend = $("#qerez").val();
		var qbrand = $("#qsctez").val();
		var qtype = $("#qsctcz").val();
		var tprice = $("#tpricez").val();
		var eprice = $("#epricez").val();
		var maoli = $("#maoliz").val();
		if(qstart==''||qend==''||qbrand==''||qtype==''||tprice==''||eprice==''||maoli==''){
			$.anewAlert('请完整录入信息');
			return false;
		}
		$("#quickz").submit();
	}
	function clearAll(){
		$("#qsrez").val('');
		$("#qerez").val('');
		$("#qsctez").val('');
		$("#qsctcz").val('');
		$("#tpricez").val(0);
		$("#epricez").val(0);
		$("#totalz").val(0);
		$("#tiz").val(0);
		$("#songz").val(0);
		$("#sansz").val('');
		$("#sanez").val('');
		$("#feesanz").val(0);
		$("#tidz").val('');
		$("#sidz").val('');
		$("#maoliz").val(0);
		$("#sproz").val(0);
		$("#eproz").val(0);
		$("#qsrcz").val('');
		$("#qercz").val('');
		$("#qbtz").val('');
		$("#zongz").html(0);
	}
	
	
	
