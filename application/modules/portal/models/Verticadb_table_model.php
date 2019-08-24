<?php

class Verticadb_table_model extends CI_Model {
    
    public $select_columns;
    public $table;
    public $index_column;
    public $where;
    public $staticWhere;

    public function __construct() {
        
    }

   public function get_table_list() {
       
        /* Array of table columns which should be read and sent back to DataTables. Use a space where
        * you want to insert a non-database field (for example a counter or static image)
        */
        $dbconn3 = pg_connect("host=10.8.84.195 port=5433 dbname=CognosVerticaDB user=globe123 password=globe123!");
        $aColumns = $this->select_columns;
        $aWhere = $this->where;
        $staticWhere = $this->staticWhere;
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = $this->index_column;

        /* Total data set length */
        $sQuery = "SELECT COUNT('" . $sIndexColumn . "') AS row_count
            FROM $this->table";
			
		
        $rResultTotal = pg_query($dbconn3,$sQuery);
        $aResultTotal = pg_fetch_assoc($rResultTotal);
        $iTotal = $aResultTotal["row_count"];

        /*
        * Paging
        */
        $sLimit = "";
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $sLimit = "LIMIT " . intval($iDisplayLength) . " OFFSET " .
                    intval($iDisplayStart);
        }

        $uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/%5B/", '[', $uri_string);
        $uri_string = preg_replace("/%5D/", ']', $uri_string);

        $get_param_array = explode("&", $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            $arr[$explode[0]] = $explode[1];
        }

        $index_of_columns = strpos($uri_string, "columns", 1);
        $index_of_start = strpos($uri_string, "start");
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode("&", $uri_columns);
        $arr_columns = array();
        foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
        }

        /*
        * Ordering
        */
        /*$sOrder = "ORDER BY ";
        $sOrderIndex = $arr['order[0][column]'];
        $sOrderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $sOrderIndex . '][orderable]'];
        if ($bSortable_ == "true") {
            $sOrder .= $aWhere[$sOrderIndex] .
                    ($sOrderDir === 'asc' ? ' asc' : ' desc');
        }*/

        /*
        * Filtering
        */
        $sWhere = "";
        $sSearchVal = $arr['search[value]'];
        if (isset($sSearchVal) && $sSearchVal != '') {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aWhere); $i++) {
                $sWhere .= $aWhere[$i] . " LIKE '%" . addslashes(urldecode($sSearchVal)) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /* Individual column filtering */
        $sSearchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($aColumns); $i++) {
            $bSearchable_ = $arr['columns[' . $i . '][searchable]'];
            if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . addslashes(urldecode($search_val)). "%' ";
          
            }
        }

        if($sWhere == "")
        {
            if($staticWhere != "")
            {
                 $sWhere = " WHERE ".$staticWhere;
            }
        }
        else
        { 
            if($staticWhere != "")
            {
                $sWhere .= " AND " .$staticWhere;
            }
        }
        /*
        * SQL queries
        * Get data to display
        */
        $sQuery = "SELECT " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM $this->table
        $sWhere
        ORDER BY CREATIONDATE DESC 
        $sLimit
        ";  
        $rResult = pg_query($dbconn3,$sQuery);

        $result = array();
        while($row = pg_fetch_assoc($rResult))
        {
            array_push($result,$row);
        }
        
        $sQuery = "SELECT COUNT('TICKETID') as count FROM $this->table
        $sWhere";
        
        $rResult = pg_query($dbconn3,$sQuery);
        $count = pg_fetch_assoc($rResult);
        //$iFilteredTotal = pg_num_rows($rResult);

        $iFilteredTotal = $count["count"];
        /*
        * Output
        */
        $sEcho = $this->input->get_post('draw', true);
        //var_dump($result);
        //die();
         
        $output = array(
            "draw" => intval($sEcho),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "data" => array()
        );

        $return["output"] = $output;
        $return["rResult"] = $result;
        $return["aColumns"] = $aColumns;
       
        return $return;
    }
}

?>