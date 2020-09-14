<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends CI_Model 
{
	public function __construct() 
    {
        parent::__construct(); 

        $this->load->database();
    }
    public function checkUser($params)
	{
		$query=$this->db->select("*")->from("users")->where(array("email" => $params["email"],"password" => $params["password"], "status" => 1))->where_in("usertype",array(1,2))->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function getUserDetailsByEmail($email)
	{
		$this->db->select("*")->from('users')->where("email",$email);
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		if($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function getUserDetails($email)
	{
		$this->db->select("*")->from("users")->where(array("usertype" => 1,"email" => $email));
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return array();
		}
	}
	
	public function updateNewPassword($params,$email)
	{
		$query=$this->db->update("users",$params,array("email" => $email));
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	
	public function getSuperAdminUserDetails()
	{
		$this->db->select("email,mobile")->from("users")->where(array("usertype" => 1,"status" => 1));
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return array();
		}
	}	
	
	public function getSitename()
	{
		$query = $this->db->select("*")->from("configurations")->where(array("configTitle" => "sitename"))->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return array();
		}
	}
	
	public function getAllInfo($table,$orderBy=null)
	{
		if($orderBy !='')
		{
			$this->db->order_by($orderBy,"ASC");
		}
		$query = $this->db->select("*")->from($table)->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return array();
		}
	}
    public function storeItems($table,$params)
	{
		$query = $this->db->insert($table,$params);
		if($query)
		{
			return $this->db->insert_id();
		}
		else
		{
			return 0;
		}
	}
    public function getTableAllDataOrder($table,$column,$order)
	{
		$this->db->select("*")->from($table)->order_by($column,$order);

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataOrder($table,$where,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}

	}
	public function getTableRowDataOrderClmByLimit($table,$where,$column,$order,$clm,$start,$end)
	{
		$this->db->select($clm)->from($table)->where($where)->order_by($column,$order)->limit($end,$start);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getInfobyId($table,$bannerid)
	{
		$query = $this->db->select("*")->from($table)->where("id",$bannerid)->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return array();
		}
	}
	public function updateItems($table,$params,$bannerid)
	{
		$query=$this->db->update($table,$params,array("id" => $bannerid));
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function updateDataItems($table,$params,$where)
	{
		$query=$this->db->update($table,$params,$where);
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function removeUploadedImage($table,$rowId,$folder,$coloumn)
	{
		$this->db->select("*")->from($table)->where(array("id" => $rowId));
		$query=$this->db->get();
		//echo $this->db->last_query();die();
		if($query->num_rows() > 0)
		{
			$result=$query->result();
			$delete=@unlink(FCPATH . 'uploads/'.@$folder.'/' . $result[0]->$coloumn);
			if($delete)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
	}
	public function deleteDatawithMedia($table,$rowId,$folder,$coloumn)
	{
		$this->db->select("*")->from($table)->where(array("id" => $rowId));
		$query=$this->db->get();
		//echo $this->db->last_query();die();
		if($query->num_rows() > 0)
		{
			$result=$query->result();
			$delete=$this->db->delete($table,array("id" => $rowId));
			if($delete)
			{
				@unlink(FCPATH . 'uploads/'.@$folder.'/' . $result[0]->$coloumn);
				return 1;
			}
			else
			{
				return 0;
			}
		}
	}
	public function getInfoByPage($table,$page)
	{
		$query = $this->db->select("*")->from($table)->where("page_type",$page)->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return array();
		}
	}
	public function removeRowItems($table,$where)
	{
		$query = $this->db->delete($table,$where);
		if($query)
		{
			return 1;
		}

		else
		{
			return 0;
		}
	}
	public function getTableRowDataOrderClm($table,$where,$column,$order,$clm)
	{
		$this->db->select($clm)->from($table)->where($where)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	
	public function getTableRowDataByGroup($table,$where,$column)
	{
		$this->db->select("*")->from($table)->where($where)->group_by($column);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}

	}
	public function getTableRowDataOrderSize($table,$where,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}

	}
	public function getTableRowDataOrderByGroup($table,$where,$column,$order,$grpby,$clm)
	{
		$this->db->select($clm)->from($table)->where($where)->order_by($column,$order)->group_by($grpby);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}

	}
	public function checkCategoryExistOrNot($enterVal)
	{
		$this->db->select("*")->from("categories")->where(array("cat_name" => $enterVal))->where_not_in("status",array(2));		
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function checkCategoryExistOrNotIn($enterVal,$rowId)
	{
		$this->db->select("*")->from("categories")->where(array("cat_name" => $enterVal))->where_not_in("id",array($rowId))->where_not_in("status",array(2));		
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function checkSubCategoryExistOrNot($enterVal,$catId)
	{
		$this->db->select("*")->from("categories")->where(array("cat_name" => $enterVal,"parent_id" => $catId))->where_not_in("status",array(2));			
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	
	public function checkSubCategoryExistOrNotIn($enterVal,$rowId,$catId)
	{
		$this->db->select("*")->from("categories")->where(array("cat_name" => $enterVal,"parent_id" => $catId))->where_not_in("id",array($rowId))->where_not_in("status",array(2));		
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function checklocationsExistOrNot($enterVal,$catId)
	{
		$this->db->select("*")->from("locations")->where(array("location_name" => $enterVal,"country_id" => $catId))->where_not_in("status",array(2));			
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	
	public function checklocationsExistOrNotIn($enterVal,$rowId,$catId)
	{
		$this->db->select("*")->from("locations")->where(array("location_name" => $enterVal,"country_id" => $catId))->where_not_in("id",array($rowId))->where_not_in("status",array(2));		
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function getPlanTransactions($planId,$page_type=null)
	{
		if(@$planId !='' && @$planId !=0)
		{
			$this->db->where(array("plan_id" => $planId));
		}
		if(@$page_type !='')
		{
			$this->db->where(array("page_type" => $page_type));
		}
		$this->db->select("SUM(pay_amount) as totalamount")->from("vendor_subscriptions")->where(array("pay_status"=>'SUCCESS'));
		$query = $this->db->get();
		//echo $this->db->last_query()."<br>";
		if($query->num_rows() > 0)
		{
			$result=$query->result();
			return @$result[0]->totalamount;
		}
		else
		{
			return 0;
		}
	}
	public function getPlanTransactionsCount($planId,$page_type=null)
	{
		if(@$planId !='')
		{
			$this->db->where(array("plan_id" => $planId));
		}
		if(@$page_type !='')
		{
			$this->db->where(array("page_type" => $page_type));
		}
		$this->db->select("*")->from("vendor_subscriptions")->where(array("pay_status"=>'SUCCESS'));
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}
	public function getPlanUsers($planId,$page_type=null)
	{
		if(@$planId !='')
		{
			$this->db->where(array("plan_id" => $planId));
		}
		if(@$page_type !='')
		{
			$this->db->where(array("page_type" => $page_type));
		}
		$this->db->select("user_id")->from("vendor_subscriptions")->group_by("user_id")->where(array("pay_status"=>'SUCCESS'));
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}
	public function getTotalTransactions($countryId,$page_type=null)
	{
		if(@$page_type !='')
		{
			$this->db->where(array("page_type" => $page_type));
		}
		$this->db->select("SUM(pay_amount) as totalamount")->from("vendor_subscriptions")->where(array("pay_status"=>'SUCCESS',"country_id"=>$countryId));
		$query = $this->db->get();
		//echo $this->db->last_query()."<br>";
		if($query->num_rows() > 0)
		{
			$result=$query->result();
			return @$result[0]->totalamount;
		}
		else
		{
			return 0;
		}
	}
	public function getComments($job_id,$page_type,$country_id){
		$this->db->select('a.*,b.firstname,b.profile_pic')->from('post_comments a');
		$this->db->join("users b","a.userid = b.id","LEFT");
		$this->db->where(array('a.status'=>1,'b.status'=>1,"a.parent_id"=>$job_id,"a.page_type"=>$page_type,"a.country_id"=>$country_id));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataOrderLimit($table,$where,$limit,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->limit($limit,0)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}

	}
	public function getTableRowDataWhereIn($table,$where,$column,$array)
	{
		if(@sizeOf($array) > 0)
		{
			$this->db->select("*")->from($table)->where($where)->where_in($column,$array);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return array();
			}
		}
		else
		{
			return array();
		}

	}
}