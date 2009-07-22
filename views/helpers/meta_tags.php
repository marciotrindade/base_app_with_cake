<?php
class MetaTagsHelper extends Helper
{
  function generate($meta, $title_for_layout)
  {
    $meta = $this->metaTags($meta);
    
    $html = "";
    if(isset($meta["title"])){
          $html .= '<title>'.h($meta["title"]).'</title>';
     }else{
         $html .= "<title>".h(Configure::read('Project.name') . " " . $title_for_layout)."</title>";
     }
    if(isset($meta["description"])){
          $html .= '<META NAME="description" CONTENT="'.h($meta["description"]).'" />';
     }
    if(isset($meta["keywords"])){
          $html .= '<META NAME="keywords" CONTENT="'.h($meta["keywords"]).'" />';
     }
     return $html;
  }

  function metaTags($meta)
  {
     $mtags = array();
     if(isSet($meta["metatitle"]) && !empty($meta["metatitle"])){
         $mtags["title"] = $meta["metatitle"];
     }else{
        $mtags["title"] = "";
     }
     
     if(isSet($meta["metadescription"]) && !empty($meta["metadescription"])){
         $mtags["description"] = $meta["metadescription"];
     }else{
         $mtags["description"] = "";
     }
     
     if(isSet($meta["metakeywords"]) && !empty($meta["metakeywords"])){
         $mtags["keywords"] = $meta["metakeywords"];
     }else{
         $mtags["keywords"] = "";
     }
     return $mtags;
  }
}
?>
