<?php

/* gallery/views/list/templates/photo_list.twig */
class __TwigTemplate_6bdb3df871255d0b7f92e2be5d81a9f7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"menu-add\">
    <h1>";
        // line 2
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_session_photos");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" method=\"POST\">
        <div class=\"buttons\">
            <div class=\"btn-group\">
                <a href=\"";
        // line 6
        if (isset($context["back"])) { $_back_ = $context["back"]; } else { $_back_ = null; }
        echo $_back_;
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-chevron-left\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_back");
        echo "</a>
                <a href=\"";
        // line 7
        if (isset($context["add"])) { $_add_ = $context["add"]; } else { $_add_ = null; }
        echo $_add_;
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_add");
        echo "</a>
            </div>
            <div style=\"clear: both;\"></div>
        </div>
        <div class=\"row\">
            ";
        // line 12
        if (isset($context["images"])) { $_images_ = $context["images"]; } else { $_images_ = null; }
        if ($_images_) {
            // line 13
            echo "                ";
            if (isset($context["images"])) { $_images_ = $context["images"]; } else { $_images_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_images_);
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 14
                echo "                <div class=\"col-sm-6 col-md-3 image\">
                    <div class=\"thumbnail\">
                        <img src=\"";
                // line 16
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo $this->getAttribute($_image_, "path");
                echo "\" alt=\"\"/>
                        <div class=\"caption\">
                            <h5 style=\"margin-bottom: 5px; height: 50px; overflow: hidden;\">";
                // line 18
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo $this->getAttribute($_image_, "title");
                echo "</h5>
                            <div class=\"btn-group\">
                                <a href=\"";
                // line 20
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo $this->getAttribute($_image_, "edit");
                echo "\" title=\"";
                if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                echo $this->getAttribute($_ln_, "gallery_edit");
                echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-pencil\"></i></a>
                                <button class=\"btn btn-default\" type=\"submit\" name=\"delete\" value=\"";
                // line 21
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo $this->getAttribute($_image_, "id");
                echo "\" title=\"";
                if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                echo $this->getAttribute($_ln_, "gallery_delete");
                echo "\"><i class=\"glyphicon glyphicon-trash\"></i></button>
                                <button title=\"";
                // line 22
                if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                echo $this->getAttribute($_ln_, "gallery_move_left");
                echo "\" type=\"submit\" class=\"btn btn-default ";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                if ($this->getAttribute($_image_, "disabledUp")) {
                    echo "disabled";
                }
                echo "\" ";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                if ($this->getAttribute($_image_, "disabledUp")) {
                    echo "disabled=\"disabled\"";
                }
                echo " name=\"moveLeft\" value=\"";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo $this->getAttribute($_image_, "id");
                echo "\"><i class=\"glyphicon glyphicon-chevron-left\"></i></button>
                                <button title=\"";
                // line 23
                if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                echo $this->getAttribute($_ln_, "gallery_move_right");
                echo "\" type=\"submit\" class=\"btn btn-default ";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                if ($this->getAttribute($_image_, "disabledDown")) {
                    echo "disabled";
                }
                echo "\" ";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                if ($this->getAttribute($_image_, "disabledDown")) {
                    echo "disabled=\"disabled\"";
                }
                echo " name=\"moveRight\" value=\"";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo $this->getAttribute($_image_, "id");
                echo "\"><i class=\"glyphicon glyphicon-chevron-right\"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 29
            echo "            ";
        } else {
            // line 30
            echo "            <p>";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "gallery_no_images");
            echo "</p>
            ";
        }
        // line 32
        echo "        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "gallery/views/list/templates/photo_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  147 => 32,  140 => 30,  137 => 29,  111 => 23,  93 => 22,  85 => 21,  77 => 20,  71 => 18,  65 => 16,  61 => 14,  55 => 13,  52 => 12,  40 => 7,  32 => 6,  25 => 3,  20 => 2,  17 => 1,);
    }
}
