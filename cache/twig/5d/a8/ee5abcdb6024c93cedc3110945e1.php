<?php

/* gallery/views/list/templates/size_list.twig */
class __TwigTemplate_5da8ee5abcdb6024c93cedc3110945e1 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "gallery_sizes");
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
                <button name=\"task\" value=\"delete\" type=\"submit\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-trash\"></i>&nbsp;";
        // line 8
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_delete");
        echo "</button>
            </div>
            <div style=\"clear: both;\"></div>
        </div>
        <div class=\"menus\">
            <table class=\"table table-striped\">
                <tr>
                    <th class=\"th30\"><input type=\"checkbox\" class=\"check-all\"></th>
                    <th class=\"th30\">ID</th>
                    <th>";
        // line 17
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_name");
        echo "</th>
                    <th>";
        // line 18
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_width");
        echo "</th>
                    <th>";
        // line 19
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_height");
        echo "</th>
                    <th class=\"th100\"></th>
                </tr>
                ";
        // line 22
        if (isset($context["sizes"])) { $_sizes_ = $context["sizes"]; } else { $_sizes_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_sizes_);
        foreach ($context['_seq'] as $context["_key"] => $context["size"]) {
            // line 23
            echo "                    <tr>
                        <td><input type=\"checkbox\" class=\"check-item\" name=\"item[]\" value=\"";
            // line 24
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "\"></td>
                        <td>";
            // line 25
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "</td>
                        <td><a href=\"";
            // line 26
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "edit");
            echo "\">";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "title");
            echo "</a></td>
                        <td>";
            // line 27
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "width");
            echo "</td>
                        <td>";
            // line 28
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "height");
            echo "</td>
                        <td class=\"btnset\">
                            <a href=\"";
            // line 30
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "edit");
            echo "\" title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "gallery_edit");
            echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-pencil\"></i></a>
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['size'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 34
        echo "            </table>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "gallery/views/list/templates/size_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 34,  115 => 30,  109 => 28,  104 => 27,  96 => 26,  91 => 25,  86 => 24,  83 => 23,  78 => 22,  71 => 19,  66 => 18,  61 => 17,  48 => 8,  40 => 7,  32 => 6,  25 => 3,  20 => 2,  17 => 1,);
    }
}
