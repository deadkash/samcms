<?php

/* users/views/list/templates/users_list.twig */
class __TwigTemplate_6bfe022225b8a128384b4175756a76f2 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "users_users");
        echo "</h1>
    <ul class=\"nav nav-tabs\">
        <li class=\"active\"><a href=\"#\">";
        // line 4
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_users");
        echo "</a></li>
        <li><a href=\"";
        // line 5
        if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
        echo $_groups_;
        echo "\">";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_users_group");
        echo "</a></li>
    </ul>
    <form action=\"";
        // line 7
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" method=\"POST\">
        <div class=\"buttons\">
            <div class=\"btn-group\">
                <a href=\"";
        // line 10
        if (isset($context["add"])) { $_add_ = $context["add"]; } else { $_add_ = null; }
        echo $_add_;
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_add");
        echo "</a>
                <button name=\"task\" value=\"delete\" type=\"submit\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-trash\"></i>&nbsp;";
        // line 11
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_delete");
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
        // line 20
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_login");
        echo "</th>
                    <th>";
        // line 21
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_activity");
        echo "</th>
                    <th>";
        // line 22
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_group");
        echo "</th>
                    <th>";
        // line 23
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_email");
        echo "</th>
                    <th>";
        // line 24
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_date");
        echo "</th>
                    <th class=\"th100\"></th>
                </tr>
                ";
        // line 27
        if (isset($context["users"])) { $_users_ = $context["users"]; } else { $_users_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_users_);
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 28
            echo "                    <tr>
                        <td><input type=\"checkbox\" class=\"check-item\" name=\"item[]\" value=\"";
            // line 29
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "id");
            echo "\"></td>
                        <td>";
            // line 30
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "id");
            echo "</td>
                        <td><a href=\"";
            // line 31
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "edit");
            echo "\">";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "login");
            echo "</a></td>
                        <td>";
            // line 32
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            if ($this->getAttribute($_user_, "active")) {
                // line 33
                echo "                                <i class=\"glyphicon glyphicon-ok\"></i>
                            ";
            } else {
                // line 35
                echo "                                <i class=\"glyphicon glyphicon-remove\"></i>
                            ";
            }
            // line 36
            echo "</td>
                        <td>";
            // line 37
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "policy_title");
            echo "</td>
                        <td>";
            // line 38
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "email");
            echo "</td>
                        <td>";
            // line 39
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "date");
            echo "</td>
                        <td class=\"btnset\">
                            <a href=\"";
            // line 41
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "edit");
            echo "\" title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "users_edit");
            echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-pencil\"></i></a>
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 45
        echo "            </table>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "users/views/list/templates/users_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  165 => 45,  151 => 41,  145 => 39,  140 => 38,  135 => 37,  132 => 36,  128 => 35,  124 => 33,  121 => 32,  113 => 31,  108 => 30,  103 => 29,  100 => 28,  95 => 27,  88 => 24,  83 => 23,  78 => 22,  73 => 21,  68 => 20,  55 => 11,  47 => 10,  40 => 7,  31 => 5,  26 => 4,  20 => 2,  17 => 1,);
    }
}
