<?php

/* users/views/edit/templates/edit_user.twig */
class __TwigTemplate_c760ce7408e7762fa8500c4e68b30d47 extends Twig_Template
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
    <h1>Редактирование пользователя</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\" role=\"form\">
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\">ID</label>
            <div class=\"col-lg-6\">
                <span class=\"form-control uneditable-input\">";
        // line 7
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo $this->getAttribute($_user_, "id");
        echo "</span>
            </div>
        </div>
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\">";
        // line 11
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_login");
        echo "</label>
            <div class=\"col-lg-6\">
                <span class=\"form-control uneditable-input\">";
        // line 13
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo $this->getAttribute($_user_, "login");
        echo "</span>
            </div>
        </div>
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\">";
        // line 17
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_date");
        echo "</label>
            <div class=\"col-lg-6\">
                <span class=\"form-control uneditable-input\">";
        // line 19
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo $this->getAttribute($_user_, "date");
        echo "</span>
            </div>
        </div>
        <div class=\"form-group";
        // line 22
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "email_error")) {
            echo " has-error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"email\">E-mail</label>
            <div class=\"col-lg-6\">
                <input type=\"text\" class=\"form-control\" id=\"email\" name=\"email\" value=\"";
        // line 25
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo $this->getAttribute($_user_, "email");
        echo "\">
            </div>
        </div>
        <div class=\"form-group";
        // line 28
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "password_error")) {
            echo " has-error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"password\">";
        // line 29
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_password");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" value=\"\">
            </div>
        </div>
        <div class=\"form-group";
        // line 34
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "password_error")) {
            echo " has-error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"password_confirmed\">";
        // line 35
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_password_confirm");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"password\" class=\"form-control\" id=\"password_confirmed\" name=\"password_confirmed\" value=\"\">
                <p><small>";
        // line 38
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_password_description");
        echo "</small></p>
            </div>
        </div>
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\" for=\"active\">";
        // line 42
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_active");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"checkbox\" id=\"active\" name=\"active\" value=\"1\" ";
        // line 44
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if ($this->getAttribute($_user_, "active")) {
            echo "checked=\"checked\"";
        }
        echo ">
            </div>
        </div>
        <div class=\"form-group";
        // line 47
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "policy_error")) {
            echo " has-error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"policy_id\">";
        // line 48
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_group");
        echo "</label>
            <div class=\"col-lg-6\">
                ";
        // line 50
        if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
        if ($_groups_) {
            // line 51
            echo "                    <select name=\"policy_id\" id=\"policy_id\" class=\"form-control\">
                        <option value=\"0\">-- ";
            // line 52
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "core_not_selected");
            echo " --</option>
                        ";
            // line 53
            if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_groups_);
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 54
                echo "                            <option value=\"";
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
            // line 56
            echo "                    </select>
                ";
        }
        // line 58
        echo "            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-lg-6\">
                <input type=\"hidden\" name=\"task\" value=\"update\" />
                <input type=\"hidden\" name=\"user_id\" value=\"";
        // line 63
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo $this->getAttribute($_user_, "id");
        echo "\"/>
                <button class=\"btn btn-default\" type=\"submit\">";
        // line 64
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "core_save");
        echo "</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 65
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "core_cancel");
        echo "</button>
            </div>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "users/views/edit/templates/edit_user.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  202 => 65,  197 => 64,  192 => 63,  185 => 58,  181 => 56,  162 => 54,  157 => 53,  152 => 52,  149 => 51,  146 => 50,  140 => 48,  133 => 47,  124 => 44,  118 => 42,  110 => 38,  103 => 35,  96 => 34,  87 => 29,  80 => 28,  73 => 25,  64 => 22,  57 => 19,  51 => 17,  43 => 13,  37 => 11,  29 => 7,  21 => 3,  17 => 1,);
    }
}
