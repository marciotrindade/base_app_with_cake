<?php
class HHelper extends Helper
{
  var $helpers = array("Html");

  function is_current($url = null)
  {
    return ($this->here == $this->url($url));
  }

  function link_to_unless_current($title, $url = null, $htmlAttributes = array(), $confirmMessage = false, $escapeTitle = false)
  {
    if ($this->is_current($url))
    {
      return $title;
    }
    return $this->Html->link($title, $url, $htmlAttributes, $confirmMessage, $escapeTitle);
  }

  function nameize($str)
  {
    return Inflector::humanize(Inflector::underscore($str));
  }
  
  function head_tags($meta, $title_for_layout)
  {
    $meta = $this->meta_tags($meta);
    
    $html = "";
    if(isset($meta["title"])){
          $html .= '<title>'.h($meta["title"]).'</title>';
     }else{
         $html .= "<title>".h(Configure::read('Project.name') . " " . $title_for_layout)."</title>";
     }
    if(isset($meta["description"])){
          $html .= '<meta name="description" content="'.h($meta["description"]).'" />';
     }
    if(isset($meta["keywords"])){
          $html .= '<meta name="keywords" content="'.h($meta["keywords"]).'" />';
     }
     return $html;
  }

  function meta_tags($meta)
  {
     $mtags = array();
     if(isSet($meta["meta_title"]) && !empty($meta["meta_title"])){
         $mtags["title"] = $meta["meta_title"];
     }else{
        $mtags["title"] = "";
     }
     
     if(isSet($meta["meta_description"]) && !empty($meta["meta_description"])){
         $mtags["description"] = $meta["meta_description"];
     }else{
         $mtags["description"] = "";
     }
     
     if(isSet($meta["meta_keywords"]) && !empty($meta["meta_keywords"])){
         $mtags["keywords"] = $meta["meta_keywords"];
     }else{
         $mtags["keywords"] = "";
     }
     return $mtags;
  }
}
?>