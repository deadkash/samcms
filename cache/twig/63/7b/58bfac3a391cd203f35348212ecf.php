<?php

/* options/views/list/templates/list.twig */
class __TwigTemplate_637b58bfac3a391cd203f35348212ecf extends Twig_Template
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
        echo $this->getAttribute($_ln_, "options_options");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\">
        ";
        // line 4
        if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
        if ($_groups_) {
            // line 5
            echo "            <ul class=\"nav nav-tabs\">
                ";
            // line 6
            if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_groups_);
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 7
                echo "                <li";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                if ($this->getAttribute($_group_, "active")) {
                    echo " class=\"active\"";
                }
                echo "><a href=\"#tab";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                echo $this->getAttribute($_group_, "id");
                echo "\" data-toggle=\"tab\">";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                echo $this->getAttribute($_group_, "title");
                echo "</a></li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 9
            echo "            </ul>
            <div class=\"itemedit-controls\">
                <input type=\"hidden\" name=\"task\" value=\"save\" />
                <button class=\"btn btn-info\" type=\"submit\">";
            // line 12
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "options_save");
            echo "</button>
            </div>
            <div class=\"tab-content\">
                ";
            // line 15
            if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_groups_);
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 16
                echo "                    <div class=\"tab-pane";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                if ($this->getAttribute($_group_, "active")) {
                    echo " active";
                }
                echo "\" id=\"tab";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                echo $this->getAttribute($_group_, "id");
                echo "\">
                        ";
                // line 17
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_group_, "items"));
                foreach ($context['_seq'] as $context["_key"] => $context["param"]) {
                    // line 18
                    echo "                            <div class=\"form-group\">
                                <label class=\"col-lg-2 control-label\" for=\"";
                    // line 19
                    if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                    echo $this->getAttribute($_param_, "name");
                    echo "\">";
                    if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                    echo $this->getAttribute($_param_, "title");
                    echo "</label>
                                <div class=\"col-lg-6\">";
                    // line 20
                    if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                    echo $this->getAttribute($_param_, "html");
                    echo "</div>
                            </div>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['param'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 23
                echo "                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 25
            echo "            </div>
        ";
        }
        // line 27
        echo "    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "options/views/list/templates/list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 27,  120 => 25,  113 => 23,  103 => 20,  95 => 19,  92 => 18,  87 => 17,  76 => 16,  71 => 15,  64 => 12,  59 => 9,  41 => 7,  36 => 6,  33 => 5,  30 => 4,  25 => 3,  20 => 2,  17 => 1,);
    }
}
