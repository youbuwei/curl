<?php
include_once 'curlGet.php';
class dataParse {
	
	public function getdomain($url = NULL) {
		
		$i = 0;
		
		$domain = parse_url($url); 
		$domain = explode(".", $domain['host']);	
		foreach ($domain as $value) {
			if ( $value == 'net' || $value == 'com' || $value == 'cn' ) {
			unset($domain[$i]);
			}
			$i++;
		}  		
		return array_pop($domain);
	}
	
	public function geturl($url = NULL) {
	
		$domain = $this->getdomain($url);
		if ($domain == '360buy') {
			preg_match('/http:\/\/[a-z]+\.360buy\.com[a-z\.\d\/]*\/(?<this>[\d]+)\.html/i',$url,$result);
			$url = 'http://m.360buy.com/cart/add.action?wareId='.$result['this'];
		}
		return $url;
	}
	
	public function getparse($url = NULL) {
		
		$domain = $this->getdomain($url);
		//查找缓存文件 
		if (file_exists('parse_data.php')) {
			$res = include 'parse_data.php';
			return $res[$domain];
		}
		//Get From Database 
		else {
			$mysql = array();
			$mysql = 'SELECT goodname,goodprice,goodimg,good_sendprice,goodurl,shopname,shopurl FROM '.$domain;
			return $mysql;
		}
	}
		
	public function collect( $url = NULL  ) {
		$url = $this->geturl($url);				//地址重定向
		if(!$url) {
			return false;
		}
		//var_dump($url);
				
		$options = array(
			CURLOPT_NOPROGRESS	=> FALSE,
			CURLOPT_UPLOAD		=> FALSE,
			CURLOPT_FOLLOWLOCATION => 1,		//302问题
		);
		
		$contents = curlGet::curl_get($url,$get,$options);
		//抓取失败 或 获取规则失败，返回false
		if ($contents === false || ($preg = $this->getparse($url)) === false ) {
			return false;
		}
		
//		var_dump($contents);
		//文档内容转换编码
//			if (strtolower($preg['charset']) != 'utf-8') {
//				$contents = iconv($preg['charset'],'UTF-8//IGNORE',$contents);
//			}
		$matches = array();
		//获取商品名称
		if(!empty($preg['goodname'])) {
			preg_match($preg['goodname'], $contents ,$matches );
			$result['goodname'] = $matches['result'];
			//商品名称转换为utf-8编码
			if (strtolower($preg['charset']) != 'utf-8') {
				$result['goodname'] = iconv($preg['charset'],'UTF-8//IGNORE',$result['goodname']);
			}
		}
		$matches = array();
		//获取商品价格
		if(!empty($preg['goodprice'])) {
			preg_match($preg['goodprice'],$contents ,$matches );
			//var_dump($matches['result']);
			$result['goodprice'] = $this->getNum($matches['result']);
		} 
		$matches = array();
		//获取商品图片地址
		if(!empty($preg['goodimg'])) {
			preg_match($preg['goodimg'],$contents ,$matches);
			$result['goodimg'] = $matches['result'];
		}
		$matches = array();
		//获取运费
		if(!empty($preg['good_sendprice'])) {
			preg_match($preg['good_sendprice'],$contents,$matches);
			$result['good_sendprice'] = $matches['result'];
		}

		$result['url'] = $url;
		$result['goodurl'] = $url;
		$result['shopname'] = $preg['shopname'];
		$result['shopurl'] = $preg['shopurl'];
		
		return $result;
	}
	
	public function getNum($var) {
		if(is_null($var)) {
			return $var = 0;
		} else {
			$nums = array("０","１","２","３","４","５","６","７","８","９","，");
			$fnums = array("0","1","2","3","4","5","6","7","8","9","");
			$var = (double)str_replace($nums,$fnums,$var);
			return $var;
		}
    }	

}
