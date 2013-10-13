<?php

/* materials/views/materialslist/templates/materialslist.twig */
class __TwigTemplate_7d4a725a25e3dc9f13c9080c6005522c extends Twig_Template
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
        echo $this->getAttribute($_ln_, "materials");
        echo "</h1>
    <ul class=\"nav nav-tabs\">
        <li class=\"active\"><a href=\"#\">";
        // line 4
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "materials");
        echo "</a></li>
        <li><a href=\"";
        // line 5
        if (isset($context["categories"])) { $_categories_ = $context["categories"]; } else { $_categories_ = null; }
        echo $_categories_;
        echo "\">";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "materials_categories");
        echo "</a></li>
    </ul>
    <form action=\"";
        // line 7
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" method=\"GET\">
        <div class=\"row materials\">
            ";
        // line 9
        if (isset($context["categoryList"])) { $_categoryList_ = $context["categoryList"]; } else { $_categoryList_ = null; }
        if ($_categoryList_) {
            // line 10
            echo "                <div class=\"buttons row pull-left\">
                    <select class=\"filter form-control\" name=\"category\">
                        <option value=\"0\">-- ";
            // line 12
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "materials_select_category");
            echo "</option>
                        ";
            // line 13
            if (isset($context["categoryList"])) { $_categoryList_ = $context["categoryList"]; } else { $_categoryList_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_categoryList_);
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 14
                echo "                            <option value=\"";
                if (isset($context["category"])) { $_category_ = $context["category"]; } else { $_category_ = null; }
                echo $this->getAttribute($_category_, "id");
                echo "\"";
                if (isset($context["category"])) { $_category_ = $context["category"]; } else { $_category_ = null; }
                if ($this->getAttribute($_category_, "current")) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                if (isset($context["category"])) { $_category_ = $context["category"]; } else { $_category_ = null; }
                echo $this->getAttribute($_category_, "title");
                echo "</option>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 16
            echo "                    </select>
                </div>
            ";
        }
        // line 19
        echo "            <div class=\"buttons row pull-right\">
                <div class=\"btn-group\">
                    <a href=\"";
        // line 21
        if (isset($context["add"])) { $_add_ = $context["add"]; } else { $_add_ = null; }
        echo $_add_;
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "materials_add");
        echo "</a>
                    <button name=\"task\" value=\"delete\" type=\"submit\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-trash\"></i>&nbsp;";
        // line 22
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "materials_delete");
        echo "</button>
                </div>
                <div style=\"clear: both;\"></div>
            </div>
        </div>
        <div class=\"menus\">
            <table class=\"table table-striped\">
                <tr>
                    <th class=\"th30\"><input type=\"checkbox\" class=\"check-all\"></th>
                    <th class=\"th30\">ID</th>
                    <th>";
        // line 32
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "materials_name");
        echo "</th>
                    <th>";
        // line 33
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "materials_cat");
        echo "</th>
                    <th>";
        // line 34
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "materials_pub_date");
        echo "</th>
                    <th class=\"th100\"></th>
                </tr>
                ";
        // line 37
        if (isset($context["materials"])) { $_materials_ = $context["materials"]; } else { $_materials_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_materials_);
        foreach ($context['_seq'] as $context["_key"] => $context["material"]) {
            // line 38
            echo "                <tr>
                    <td><input type=\"checkbox\" class=\"check-item\" name=\"item[]\" value=\"";
            // line 39
            if (isset($context["material"])) { $_material_ = $context["material"]; } else { $_material_ = null; }
            echo $this->getAttribute($_material_, "id");
            echo "\"></td>
                    <td>";
            // line 40
            if (isset($context["material"])) { $_material_ = $context["material"]; } else { $_material_ = null; }
            echo $this->getAttribute($_material_, "id");
            echo "</td>
                    <td><a href=\"";
            // line 41
            if (isset($context["material"])) { $_material_ = $context["material"]; } else { $_material_ = null; }
            echo $this->getAttribute($_material_, "edit");
            echo "\">";
            if (isset($context["material"])) { $_material_ = $context["material"]; } else { $_material_ = null; }
            echo $this->getAttribute($_material_, "title");
            echo "</a></td>
                    <td><span class=\"badge\">";
            // line 42
            if (isset($context["material"])) { $_material_ = $context["material"]; } else { $_material_ = null; }
            echo $this->getAttribute($_material_, "category_title");
            echo "</span></td>
                    <td>";
            // line 43
            if (isset($context["material"])) { $_material_ = $context["material"]; } else { $_material_ = null; }
            echo $this->getAttribute($_material_, "date");
            echo "</td>
                    <td class=\"btnset\">
                        <a href=\"";
            // line 45
            if (isset($context["material"])) { $_material_ = $context["material"]; } else { $_material_ = null; }
            echo $this->getAttribute($_material_, "edit");
            echo "\" title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "materials_edit");
            echo "\" type=\"button\" class=\"btn btn-default btn-sm\"><i class=\"glyphicon glyphicon-pencil\"></i></a>
                    </td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['material'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 49
        echo "            </table>
        </div>
        ";
        // line 51
        if (isset($context["pages"])) { $_pages_ = $context["pages"]; } else { $_pages_ = null; }
        if ($_pages_) {
            // line 52
            echo "        <div class=\"pull-right\">
            <ul class=\"pagination\">
                ";
            // line 54
            if (isset($context["pages"])) { $_pages_ = $context["pages"]; } else { $_pages_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_pages_);
            foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                // line 55
                echo "                <li";
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                if ($this->getAttribute($_page_, "disabled")) {
                    echo " class=\"disabled\"";
                }
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                if ($this->getAttribute($_page_, "selected")) {
                    echo " class=\"active\"";
                }
                echo "><a href=\"";
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                echo $this->getAttribute($_page_, "href");
                echo "\">";
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                echo $this->getAttribute($_page_, "title");
                echo "</a></li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 57
            echo "            </ul>
        </div>
        ";
        }
        // line 60
        echo "    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "materials/views/materialslist/templates/materialslist.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  223 => 60,  218 => 57,  196 => 55,  191 => 54,  187 => 52,  184 => 51,  180 => 49,  166 => 45,  160 => 43,  155 => 42,  147 => 41,  142 => 40,  137 => 39,  134 => 38,  129 => 37,  122 => 34,  117 => 33,  112 => 32,  98 => 22,  90 => 21,  86 => 19,  81 => 16,  63 => 14,  58 => 13,  53 => 12,  49 => 10,  46 => 9,  40 => 7,  31 => 5,  26 => 4,  20 => 2,  17 => 1,);
    }
}
