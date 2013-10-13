<?php

/* users/views/policy/templates/policy.twig */
class __TwigTemplate_c3d06595140194fd73a9a0eab54d8775 extends Twig_Template
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
    <h1>Политики доступа <small>";
        // line 2
        if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
        echo $this->getAttribute($_group_, "name");
        echo "</small></h1>
    ";
        // line 3
        if (isset($context["menus"])) { $_menus_ = $context["menus"]; } else { $_menus_ = null; }
        if ($_menus_) {
            // line 4
            echo "    <form action=\"";
            if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
            echo $_url_;
            echo "\" method=\"POST\">
        ";
            // line 5
            if (isset($context["menus"])) { $_menus_ = $context["menus"]; } else { $_menus_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_menus_);
            foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
                // line 6
                echo "        <div class=\"menus\">
            <table class=\"table table-bordered policy\">
                <tr>
                    <th colspan=\"3\"><strong>";
                // line 9
                if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
                echo $this->getAttribute($_menu_, "title");
                echo "</strong></th>
                </tr>
                ";
                // line 11
                if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_menu_, "items"));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 12
                    echo "                    <tr>
                        <td class=\"title\">";
                    // line 13
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo $this->getAttribute($_item_, "title");
                    echo "</td>
                        <td><label><input type=\"checkbox\" name=\"allow[]\" value=\"";
                    // line 14
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo $this->getAttribute($_item_, "id");
                    echo "\" ";
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    if ($this->getAttribute($_item_, "allow_id")) {
                        echo "checked=\"checked\"";
                    }
                    echo "/> ";
                    if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                    echo $this->getAttribute($_ln_, "users_allow");
                    echo "</label></td>
                        <td><label><input type=\"checkbox\" name=\"deny[]\" value=\"";
                    // line 15
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo $this->getAttribute($_item_, "id");
                    echo "\" ";
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    if ($this->getAttribute($_item_, "deny_id")) {
                        echo "checked=\"checked\"";
                    }
                    echo "/> ";
                    if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                    echo $this->getAttribute($_ln_, "users_deny");
                    echo "</label></td>
                    </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 18
                echo "            </table>
        </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 21
            echo "        <input type=\"hidden\" name=\"task\" value=\"policy\"/>
        <input type=\"hidden\" name=\"policy_id\" value=\"";
            // line 22
            if (isset($context["policy_id"])) { $_policy_id_ = $context["policy_id"]; } else { $_policy_id_ = null; }
            echo $_policy_id_;
            echo "\"/>
        <button class=\"btn btn-default\" type=\"submit\">";
            // line 23
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "core_save");
            echo "</button>
        <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
            // line 24
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "core_cancel");
            echo "</button>
    </form>
    ";
        }
        // line 27
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "users/views/policy/templates/policy.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 27,  115 => 24,  110 => 23,  105 => 22,  102 => 21,  94 => 18,  76 => 15,  63 => 14,  58 => 13,  55 => 12,  50 => 11,  44 => 9,  39 => 6,  34 => 5,  28 => 4,  25 => 3,  20 => 2,  17 => 1,);
    }
}
