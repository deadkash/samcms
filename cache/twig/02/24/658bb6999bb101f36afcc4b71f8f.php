<?php

/* menueditor/views/edititem/templates/edititem.twig */
class __TwigTemplate_0224658bb6999bb101f36afcc4b71f8f extends Twig_Template
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
        echo $this->getAttribute($_ln_, "menueditor_editmenuitem");
        echo " <small>";
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        echo $this->getAttribute($_menuItem_, "title");
        echo "</small></h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\" enctype=\"multipart/form-data\">
        <ul class=\"nav nav-tabs\">
            <li class=\"active\"><a href=\"#tab1\" data-toggle=\"tab\">";
        // line 5
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_main_params");
        echo "</a></li>
            ";
        // line 6
        if (isset($context["section_parameters"])) { $_section_parameters_ = $context["section_parameters"]; } else { $_section_parameters_ = null; }
        if ($_section_parameters_) {
            // line 7
            echo "                <li><a href=\"#tab2\" data-toggle=\"tab\">";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_section_params");
            echo "</a></li>
            ";
        }
        // line 9
        echo "            ";
        if (isset($context["component_parameters"])) { $_component_parameters_ = $context["component_parameters"]; } else { $_component_parameters_ = null; }
        if ($_component_parameters_) {
            // line 10
            echo "                <li><a href=\"#tab3\" data-toggle=\"tab\">";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_component_params");
            echo "</a></li>
            ";
        }
        // line 12
        echo "            ";
        if (isset($context["sectionModules"])) { $_sectionModules_ = $context["sectionModules"]; } else { $_sectionModules_ = null; }
        if ($_sectionModules_) {
            // line 13
            echo "                <li><a href=\"#tab4\" data-toggle=\"tab\">";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_section_modules");
            echo "</a></li>
            ";
        }
        // line 15
        echo "        </ul>
        <div class=\"itemedit-controls\">
            <input type=\"hidden\" name=\"main_menu_item_id\" value=\"";
        // line 17
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        echo $this->getAttribute($_menuItem_, "id");
        echo "\"/>
            <input type=\"hidden\" name=\"task\" value=\"upditem\"/>
            <div class=\"btn-group\">
                <button class=\"btn btn-default btn-info\" type=\"submit\">";
        // line 20
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_save");
        echo "</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 21
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_cancel");
        echo "</button>
            </div>
        </div>
        <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab1\">
                <div class=\"form-group\">
                    <label class=\"col-lg-2 control-label\"><strong>ID</strong></label>
                    <div class=\"col-lg-6\">
                        <span class=\"form-control uneditable-input\">";
        // line 29
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        echo $this->getAttribute($_menuItem_, "id");
        echo "</span>
                    </div>
                </div>
                ";
        // line 32
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        if ($this->getAttribute($_menuItem_, "component_title")) {
            // line 33
            echo "                    <div class=\"form-group\">
                        <label class=\"col-lg-2 control-label\"><strong>";
            // line 34
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_component");
            echo "</strong></label>
                        <div class=\"col-lg-6\">
                            <span class=\"form-control uneditable-input\">";
            // line 36
            if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
            echo $this->getAttribute($_menuItem_, "component_title");
            echo "</span>
                        </div>
                    </div>
                ";
        }
        // line 40
        echo "                <div class=\"form-group";
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "items_empty_menu")) {
            echo " error";
        }
        echo "\">
                    <label class=\"col-lg-2 control-label\" for=\"menu_id\"><strong>";
        // line 41
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_menu");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <select name=\"main_menu_id\" id=\"menu_id\" class=\"form-control\">
                            <option value=\"0\">-- ";
        // line 44
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_empty_choice");
        echo "</option>
                            ";
        // line 45
        if (isset($context["menuList"])) { $_menuList_ = $context["menuList"]; } else { $_menuList_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_menuList_);
        foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
            // line 46
            echo "                                <option value=\"";
            if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
            echo $this->getAttribute($_menu_, "id");
            echo "\"";
            if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
            if ($this->getAttribute($_menu_, "selected")) {
                echo " selected";
            }
            echo ">";
            if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
            echo $this->getAttribute($_menu_, "title");
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 48
        echo "                        </select>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"col-lg-2 control-label\" for=\"parent_id\"><strong>";
        // line 52
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_parent");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <select name=\"main_parent_id\" id=\"parent_id\" class=\"form-control\">
                            <option value=\"0\">** ";
        // line 55
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_empty_choice");
        echo " **</option>
                            ";
        // line 56
        if (isset($context["parentList"])) { $_parentList_ = $context["parentList"]; } else { $_parentList_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_parentList_);
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 57
            echo "                                <option value=\"";
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "id");
            echo "\"";
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            if ($this->getAttribute($_item_, "selected")) {
                echo " selected=\"selected\"";
            }
            echo ">";
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "title");
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 59
        echo "                        </select>
                    </div>
                </div>
                <div class=\"form-group";
        // line 62
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "items_empty_title")) {
            echo " error";
        }
        echo "\">
                    <label class=\"col-lg-2 control-label\" for=\"title\"><strong>";
        // line 63
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_title");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <input type=\"text\" class=\"form-control\" id=\"title\" name=\"main_title\" value=\"";
        // line 65
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        echo $this->getAttribute($_menuItem_, "title");
        echo "\">
                    </div>
                </div>
                <div class=\"form-group";
        // line 68
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "items_alias_exists")) {
            echo " error";
        }
        echo "\">
                    <label class=\"col-lg-2 control-label\" for=\"alias\"><strong>";
        // line 69
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_alias");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <input type=\"text\" class=\"form-control\" id=\"alias\" name=\"main_alias\" value=\"";
        // line 71
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        echo $this->getAttribute($_menuItem_, "alias");
        echo "\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"col-lg-2 control-label\" for=\"link\"><strong>";
        // line 75
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_link");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <input type=\"text\" class=\"form-control\" id=\"link\" name=\"main_link\" value=\"";
        // line 77
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        echo $this->getAttribute($_menuItem_, "link");
        echo "\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"col-lg-2 control-label\" for=\"active\"><strong>";
        // line 81
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_active");
        echo "</strong></label>
                    <div class=\"col-lg-6\"\">
                        <input type=\"checkbox\" class=\"input-xlarge\" id=\"active\" name=\"main_active\" value=\"1\" ";
        // line 83
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        if ($this->getAttribute($_menuItem_, "active")) {
            echo "checked=\"checked\"";
        }
        echo ">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"col-lg-2 control-label\" for=\"visible\"><strong>";
        // line 87
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_visible");
        echo "</strong></label>
                    <div class=\"col-lg-6\"\">
                        <input type=\"checkbox\" class=\"input-xlarge\" id=\"visible\" name=\"main_visible\" value=\"1\" ";
        // line 89
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        if ($this->getAttribute($_menuItem_, "visible")) {
            echo "checked=\"checked\"";
        }
        echo ">
                    </div>
                </div>
            </div>
            ";
        // line 93
        if (isset($context["section_parameters"])) { $_section_parameters_ = $context["section_parameters"]; } else { $_section_parameters_ = null; }
        if ($_section_parameters_) {
            // line 94
            echo "                <div class=\"tab-pane\" id=\"tab2\">
                    ";
            // line 95
            if (isset($context["section_parameters"])) { $_section_parameters_ = $context["section_parameters"]; } else { $_section_parameters_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_section_parameters_);
            foreach ($context['_seq'] as $context["_key"] => $context["param"]) {
                // line 96
                echo "                        <div class=\"form-group\">
                            <label class=\"col-lg-2 control-label\" for=\"";
                // line 97
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "name");
                echo "\"><strong>";
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "title");
                echo "</strong></label>
                            <div class=\"col-lg-6\">";
                // line 98
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "html");
                echo "</div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['param'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 101
            echo "                </div>
            ";
        }
        // line 103
        echo "            ";
        if (isset($context["component_parameters"])) { $_component_parameters_ = $context["component_parameters"]; } else { $_component_parameters_ = null; }
        if ($_component_parameters_) {
            // line 104
            echo "                <div class=\"tab-pane\" id=tab3>
                    ";
            // line 105
            if (isset($context["component_parameters"])) { $_component_parameters_ = $context["component_parameters"]; } else { $_component_parameters_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_component_parameters_);
            foreach ($context['_seq'] as $context["_key"] => $context["param"]) {
                // line 106
                echo "                        <div class=\"form-group\">
                            <label class=\"col-lg-2 control-label\" for=\"";
                // line 107
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "name");
                echo "\"><strong>";
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "title");
                echo "</strong></label>
                            <div class=\"col-lg-10\">";
                // line 108
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "html");
                echo "</div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['param'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 111
            echo "                </div>
            ";
        }
        // line 113
        echo "            ";
        if (isset($context["sectionModules"])) { $_sectionModules_ = $context["sectionModules"]; } else { $_sectionModules_ = null; }
        if ($_sectionModules_) {
            // line 114
            echo "                <div class=\"tab-pane\" id=\"tab4\">
                    ";
            // line 115
            if (isset($context["sectionModules"])) { $_sectionModules_ = $context["sectionModules"]; } else { $_sectionModules_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_sectionModules_);
            foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                // line 116
                echo "                        <div class=\"form-group\">
                            <label class=\"col-lg-2 control-label\" for=\"mod";
                // line 117
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                echo $this->getAttribute($_module_, "id");
                echo "\">";
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                echo $this->getAttribute($_module_, "title");
                echo "</label>
                            <div class=\"col-lg-6\">
                                <input type=\"checkbox\" name=\"modules[]\" id=\"mod";
                // line 119
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                echo $this->getAttribute($_module_, "id");
                echo "\" value=\"";
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                echo $this->getAttribute($_module_, "id");
                echo "\" ";
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                if ($this->getAttribute($_module_, "checked")) {
                    echo " checked=\"checked\"";
                }
                echo "/>
                            </div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 123
            echo "                </div>
            ";
        }
        // line 125
        echo "        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "menueditor/views/edititem/templates/edititem.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  422 => 125,  418 => 123,  399 => 119,  390 => 117,  387 => 116,  382 => 115,  379 => 114,  375 => 113,  371 => 111,  361 => 108,  353 => 107,  350 => 106,  345 => 105,  342 => 104,  338 => 103,  334 => 101,  324 => 98,  316 => 97,  313 => 96,  308 => 95,  305 => 94,  302 => 93,  292 => 89,  286 => 87,  276 => 83,  270 => 81,  262 => 77,  256 => 75,  248 => 71,  242 => 69,  235 => 68,  228 => 65,  222 => 63,  215 => 62,  210 => 59,  192 => 57,  187 => 56,  182 => 55,  175 => 52,  169 => 48,  151 => 46,  146 => 45,  141 => 44,  134 => 41,  126 => 40,  118 => 36,  112 => 34,  109 => 33,  106 => 32,  99 => 29,  87 => 21,  82 => 20,  75 => 17,  71 => 15,  64 => 13,  60 => 12,  53 => 10,  49 => 9,  42 => 7,  39 => 6,  34 => 5,  28 => 3,  20 => 2,  17 => 1,);
    }
}
