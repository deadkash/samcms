<?php

/* menueditor/views/additem/templates/additem.twig */
class __TwigTemplate_970026288c4b3ab6bfad4b0aa312cb37 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "menueditor_newitem");
        echo "</h1>
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
        if (isset($context["sectionParameters"])) { $_sectionParameters_ = $context["sectionParameters"]; } else { $_sectionParameters_ = null; }
        if ($_sectionParameters_) {
            // line 7
            echo "                <li><a href=\"#tab2\" data-toggle=\"tab\">";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_section_params");
            echo "</a></li>
            ";
        }
        // line 9
        echo "            ";
        if (isset($context["componentParameters"])) { $_componentParameters_ = $context["componentParameters"]; } else { $_componentParameters_ = null; }
        if ($_componentParameters_) {
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
            <input type=\"hidden\" name=\"menu_id\" value=\"";
        // line 17
        if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
        echo $this->getAttribute($_menu_, "id");
        echo "\"/>
            <input type=\"hidden\" name=\"component\" value=\"";
        // line 18
        if (isset($context["component"])) { $_component_ = $context["component"]; } else { $_component_ = null; }
        echo $_component_;
        echo "\" />
            <input type=\"hidden\" name=\"task\" value=\"saveitem\"/>
            <div class=\"btn-group\">
                <button class=\"btn btn-default btn-info\" type=\"submit\">";
        // line 21
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_save");
        echo "</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 22
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_cancel");
        echo "</button>
            </div>
        </div>
        <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab1\">
                <div class=\"form-group\">
                    <label class=\"col-lg-2 control-label\"><strong>";
        // line 28
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_menu");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <span class=\"form-control uneditable-input\">";
        // line 30
        if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
        echo $this->getAttribute($_menu_, "title");
        echo "</span>
                    </div>
                </div>
                <div class=\"form-group";
        // line 33
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "items_empty_title")) {
            echo " error";
        }
        echo "\">
                    <label class=\"col-lg-2 control-label\" for=\"title\"><strong>";
        // line 34
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_title");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <input type=\"text\" class=\"form-control\" id=\"title\" name=\"title\" value=\"";
        // line 36
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        echo $this->getAttribute($_menuItem_, "title");
        echo "\">
                    </div>
                </div>
                <div class=\"form-group";
        // line 39
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "items_alias_exists")) {
            echo " error";
        }
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "items_alias_system")) {
            echo " error";
        }
        echo "\">
                    <label class=\"col-lg-2 control-label\" for=\"alias\"><strong>";
        // line 40
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_alias");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <input type=\"text\" class=\"form-control\" id=\"alias\" name=\"alias\" value=\"";
        // line 42
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        echo $this->getAttribute($_menuItem_, "alias");
        echo "\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"col-lg-2 control-label\" for=\"link\"><strong>";
        // line 46
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_link");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <input type=\"text\" class=\"form-control\" id=\"link\" name=\"link\" value=\"";
        // line 48
        if (isset($context["menuItem"])) { $_menuItem_ = $context["menuItem"]; } else { $_menuItem_ = null; }
        echo $this->getAttribute($_menuItem_, "link");
        echo "\">
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
                <div class=\"form-group\">
                    <label class=\"col-lg-2 control-label\" for=\"active\"><strong>";
        // line 63
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_active");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <input type=\"checkbox\" id=\"active\" name=\"active\" value=\"1\" checked=\"checked\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"col-lg-2 control-label\" for=\"visible\"><strong>";
        // line 69
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_visible");
        echo "</strong></label>
                    <div class=\"col-lg-6\">
                        <input type=\"checkbox\" id=\"visible\" name=\"visible\" value=\"1\" checked=\"checked\">
                    </div>
                </div>
            </div>
            ";
        // line 75
        if (isset($context["sectionParameters"])) { $_sectionParameters_ = $context["sectionParameters"]; } else { $_sectionParameters_ = null; }
        if ($_sectionParameters_) {
            // line 76
            echo "                <div class=\"tab-pane\" id=\"tab2\">
                    ";
            // line 77
            if (isset($context["sectionParameters"])) { $_sectionParameters_ = $context["sectionParameters"]; } else { $_sectionParameters_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_sectionParameters_);
            foreach ($context['_seq'] as $context["_key"] => $context["param"]) {
                // line 78
                echo "                        <div class=\"form-group\">
                            <label class=\"col-lg-2 control-label\" for=\"";
                // line 79
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "name");
                echo "\"><strong>";
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "title");
                echo "</strong></label>
                            <div class=\"col-lg-8\">";
                // line 80
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "html");
                echo "</div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['param'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 83
            echo "                </div>
            ";
        }
        // line 85
        echo "            ";
        if (isset($context["componentParameters"])) { $_componentParameters_ = $context["componentParameters"]; } else { $_componentParameters_ = null; }
        if ($_componentParameters_) {
            // line 86
            echo "                <div class=\"tab-pane\" id=\"tab3\">
                    ";
            // line 87
            if (isset($context["componentParameters"])) { $_componentParameters_ = $context["componentParameters"]; } else { $_componentParameters_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_componentParameters_);
            foreach ($context['_seq'] as $context["_key"] => $context["param"]) {
                // line 88
                echo "                        <div class=\"form-group\">
                            <label class=\"col-lg-2 control-label\" for=\"";
                // line 89
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "name");
                echo "\"><strong>";
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "title");
                echo "</strong></label>
                            <div class=\"col-lg-8\">";
                // line 90
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "html");
                echo "</div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['param'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 93
            echo "                </div>
            ";
        }
        // line 95
        echo "            ";
        if (isset($context["sectionModules"])) { $_sectionModules_ = $context["sectionModules"]; } else { $_sectionModules_ = null; }
        if ($_sectionModules_) {
            // line 96
            echo "                <div class=\"tab-pane\" id=\"tab4\">
                    ";
            // line 97
            if (isset($context["sectionModules"])) { $_sectionModules_ = $context["sectionModules"]; } else { $_sectionModules_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_sectionModules_);
            foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                // line 98
                echo "                        <div class=\"form-group\">
                            <label class=\"col-lg-2 control-label\" for=\"mod";
                // line 99
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                echo $this->getAttribute($_module_, "id");
                echo "\">";
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                echo $this->getAttribute($_module_, "title");
                echo "</label>
                            <div class=\"col-lg-8\">
                                <input type=\"checkbox\" name=\"modules[]\" id=\"mod";
                // line 101
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                echo $this->getAttribute($_module_, "id");
                echo "\" value=\"";
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                echo $this->getAttribute($_module_, "id");
                echo "\" ";
                if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
                if ($this->getAttribute($_module_, "selected")) {
                    echo "checked=\"checked\"";
                }
                echo " />
                            </div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 105
            echo "                </div>
            ";
        }
        // line 107
        echo "        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "menueditor/views/additem/templates/additem.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  352 => 107,  348 => 105,  329 => 101,  320 => 99,  317 => 98,  312 => 97,  309 => 96,  305 => 95,  301 => 93,  291 => 90,  283 => 89,  280 => 88,  275 => 87,  272 => 86,  268 => 85,  264 => 83,  254 => 80,  246 => 79,  243 => 78,  238 => 77,  235 => 76,  232 => 75,  222 => 69,  212 => 63,  206 => 59,  188 => 57,  183 => 56,  178 => 55,  171 => 52,  163 => 48,  157 => 46,  149 => 42,  143 => 40,  132 => 39,  125 => 36,  119 => 34,  112 => 33,  105 => 30,  99 => 28,  89 => 22,  84 => 21,  77 => 18,  72 => 17,  68 => 15,  61 => 13,  57 => 12,  50 => 10,  46 => 9,  39 => 7,  36 => 6,  31 => 5,  25 => 3,  20 => 2,  17 => 1,);
    }
}
