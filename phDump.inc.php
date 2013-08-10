<?php

/* ---------------------------------------------------------- */
/* THESE FUNCTIONS MIMICK THE CFDUMP FEATURE FROM COLD FUSION */
/* ---------------------------------------------------------- */

class PhDump {

	private function isAssoc( $arr ){
	    return array_keys($arr) !== range(0, count($arr) - 1);
	}

	private function prepareString( $str ){
	    if( preg_match( '/^http(|s):\/\//', $str ) )
	        return '<a href="' . $str . '">' . $str . '</a>';
	    else 
	        return $str;
	}

	private function printBoolean( $bool ){
		$html = '<span class="phDump_bool">';
		if( $bool ){
			$html .= "true";
		} else {
			$html .= "false";
		}
		$html .= '</span>';
		return $html;
	}

	private function printTableRow( $label, $content, $addClass='' ){
		$html = "";
	    $html .= '<tr><th class="sideheader' . $addClass .'" onClick="phDump_toggleRow(this)">' . $label . '</th><td>';
	    if( gettype($content) == "string" ){
	        $html .= $this->prepareString( $content )." <em>(string)</em>";
	    }
	    elseif( gettype($content) == "array" ){
	        $html .= $this->printTable($content);
	    }
	    elseif( gettype($content) == "boolean" ){
	        $html .= $this->printBoolean($content)." <em>(boolean)</em>";
	    }
	    else{
	        if( is_null($content) ){
	            $html .= '<em>null</em>';
	        } else {
	            $html .= $content." <em>(" . gettype( $content ) . ")</em>";
	        }
	    }
	    $html .= '</td></tr>';
	    return $html;
	}

	private function printTable( $results ){
	    $varType = gettype($results);
	    $addClass = '';
	    $html = "";
	    $html = '<table class="phDump_table CLASSPLACE"><tbody>';

	    $cntRows = 0;
	    if($varType == "array"){
	        if( $this->isAssoc($results) ){
	            $html .= '<tr><th class="phDump_caption CLASSPLACE" colspan="2" onClick="phDump_toggleTable(this)">Associative Array</th></tr>';
	            $addClass .= " assocarray";
	            foreach($results as $key => $value){
	                 $html .= $this->printTableRow($key,$value,$addClass);
	                 $cntRows++;
	            }

	        } else {
	            $html .= '<tr><th class="phDump_caption CLASSPLACE" colspan="2" onClick="phDump_toggleTable(this)">Numeric Array</th></tr>';
	            $addClass .= " numarray";
	            for($i = 0; $i < sizeof($results); $i++){
	                $html .= $this->printTableRow( $i, $results[$i], $addClass );
	                 $cntRows++;
	            }

	        }
	        
	    } else {
	        $html .= $this->printTableRow($varType,$results);
	        $cntRows++;
	    }

	    if( !$cntRows ){
	    	$html .= '<tr><td colspan="2"><em>empty</td></tr>';
	    }

	    $html .= '</tbody></table>';
	    $html = preg_replace( '/CLASSPLACE/', $addClass, $html );
	    return $html;
	}

	private function printJSandCSS(){
	    $html = "<script language=\"JavaScript\">

				function phDump_toggleRow(source) {
					var target = (document.all) ? source.parentElement.cells[1] : source.parentNode.lastChild;
					phDump_toggleTarget(target,phDump_toggleSource(source));
				}
				
				function phDump_toggleSource(source) {
					if (source.style.fontStyle=='italic') {
						source.style.fontStyle='normal';
						source.title='click to collapse';
						return 'open';
					} else {
						source.style.fontStyle='italic';
						source.title='click to expand';
						return 'closed';
					}
				}
			
				function phDump_toggleTarget(target,switchToState) {
					target.style.display = (switchToState=='open') ? '' : 'none';
				}
			
				function phDump_toggleTable(source) {
					var switchToState=phDump_toggleSource(source);
					if(document.all) {
						var table=source.parentElement.parentElement;
						for(var i=1;i<table.rows.length;i++) {
							target=table.rows[i];
							phDump_toggleTarget(target,switchToState);
						}
					}
					else {
						var table=source.parentNode.parentNode;
						console.log(table.childNodes.length);
						for (var i=1;i<table.childNodes.length;i++) {
							target=table.childNodes[i];
							if(target.style) {
								phDump_toggleTarget(target,switchToState);
							}
						}
					}
				}
			</script>";
		$html .= '
	    <style type="text/css">
	            .phDumpWrap{ 
	                font-family: arial, sans-serif;
	                background-color: white;
	            }
	            .phDump_bool{
	            	color: darkblue;
	            	font-weight: bold;
	            }
	            .phDump_table{ 
	            	border-collapse: collapse;
	                border: 1px solid #AAA; 
	                border-radius: 0 0 3px 3px; 
	                font-size: 10px; 
	            }
	            .phDump_table th.phDump_caption{
	            	cursor: pointer;
	                color: white;
	                border-radius: 3px 3px 0 0;
	            }
	            .phDump_table th, .phDump_table td{

	                padding: .2em .3em;
	            } 
	            .phDump_table th.sideheader{ 
	            	cursor: pointer;
	                vertical-align: top; 
	                text-align: left;
	                color: white;
	                border-bottom: 1px solid white;
	            }
	            .phDump_table td em{
	            	color: #888;
	            }
	            .phDump_table th.phDump_caption{
	            	box-shadow: inset 1px 1px 1px rgba(255,255,255,0.2), inset -1px -1px 1px rgba(0,0,0,0.2);
	            }
	            .phDump_table th.phDump_caption, .phDump_table th.sideheader{
	            	transition: background-color .1s;
	            }

	            .phDump_table th.phDump_caption.assocarray{
	                background-color: #4753C9;
	            }
	            .phDump_table th.sideheader.assocarray, .phDump_table th.phDump_caption.assocarray:hover{
	                background-color: #6673e8;

	            }
	            .phDump_table th.sideheader.assocarray:hover{
	                background-color: #828df2;
	            }

	            .phDump_table th.phDump_caption.numarray{
	                background-color: #378705;
	            }
	            .phDump_table th.sideheader.numarray, .phDump_table th.phDump_caption.numarray:hover{
	                background-color: #78c942;
	            }
	            .phDump_table th.sideheader.numarray:hover{
	            	background-color: #96e064;
	            }
	        </style>';
	    return $html;
	}

	public function printDump( $var ){
	    print $this->printJSandCSS();
	    print '<div class="phDumpWrap">';
	    print $this->printTable( $var );
	    print '</div>';
	}

}

function phDump( $var ){
	$phDump = new PhDump();
	$phDump->printDump( $var );
}