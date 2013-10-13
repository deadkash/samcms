<?php

/* users/views/add/templates/add_user.twig */
class __TwigTemplate_ccbea3038f33c3a00540504fbfb30aa9 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "users_new_user");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\" role=\"form\">
        <div class=\"form-group";
        // line 4
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "login_error")) {
            echo " error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"login\">";
        // line 5
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_login");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"text\" class=\"form-control\" id=\"login\" name=\"login\" value=\"";
        // line 7
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo $this->getAttribute($_user_, "login");
        echo "\">
            </div>
        </div>
        <div class=\"form-group";
        // line 10
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "email_error")) {
            echo " error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"email\">";
        // line 11
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_email");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"text\" class=\"form-control\" id=\"email\" name=\"email\" value=\"";
        // line 13
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo $this->getAttribute($_user_, "email");
        echo "\">
            </div>
        </div>
        <div class=\"form-group";
        // line 16
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "password_error")) {
            echo " error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"password\">";
        // line 17
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_password");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" value=\"\">
            </div>
        </div>
        <div class=\"form-group";
        // line 22
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "password_error")) {
            echo " error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"password_confirmed\">";
        // line 23
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_password_confirm");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"password\" class=\"form-control\" id=\"password_confirmed\" name=\"password_confirmed\" value=\"\">
            </div>
        </div>
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\" for=\"active\">";
        // line 29
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_active");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"checkbox\" id=\"active\" name=\"active\" value=\"1\" ";
        // line 31
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if ($this->getAttribute($_user_, "active")) {
            echo "checked=\"checked\"";
        }
        echo ">
            </div>
        </div>
        <div class=\"form-group";
        // line 34
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "policy_error")) {
            echo " error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"policy_id\">";
        // line 35
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_group");
        echo "</label>
            <div class=\"col-lg-6\">
                ";
        // line 37
        if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
        if ($_groups_) {
            // line 38
            echo "                <select name=\"policy_id\" id=\"policy_id\" class=\"form-control\">
                    <option value=\"0\">-- ";
            // line 39
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "core_not_selected");
            echo " --</option>
                    ";
            // line 40
            if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_groups_);
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 41
                echo "                    <option value=\"";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                echo $this->getAttribute($_group_, "id");
                echo "\" ";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
                if (($this->getAttribute($_group_, "id") == $this->getAttribute($_user_, "policy_id"))) {
                    echo "selected=\"selected\"";
                }
                echo ">";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                echo $this->getAttribute($_group_, "name");
                echo "</option>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 43
            echo "                </select>
                ";
        }
        // line 45
        echo "            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-lg-6\">
                <input type=\"hidden\" name=\"task\" value=\"save\" />
                <button class=\"btn btn-default\" type=\"submit\">";
        // line 50
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_save");
        echo "</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 51
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_cancel");
        echo "</button>
            </div>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "users/views/add/templates/add_user.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  182 => 51,  177 => 50,  170 => 45,  166 => 43,  147 => 41,  142 => 40,  137 => 39,  134 => 38,  131 => 37,  125 => 35,  118 => 34,  109 => 31,  103 => 29,  93 => 23,  86 => 22,  77 => 17,  70 => 16,  63 => 13,  57 => 11,  50 => 10,  43 => 7,  37 => 5,  30 => 4,  25 => 3,  20 => 2,  17 => 1,);
    }
}
