<?php

/* users/views/edit/templates/edit_group.twig */
class __TwigTemplate_4d09904686652aa039eddea5e59782d6 extends Twig_Template
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
    <h1>Редактирование группы</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\">
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\">ID</label>
            <div class=\"col-lg-6\">
                <span class=\"form-control uneditable-input\">";
        // line 7
        if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
        echo $this->getAttribute($_group_, "id");
        echo "</span>
            </div>
        </div>
        <div class=\"form-group";
        // line 10
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($this->getAttribute($_errors_, "group_upd")) {
            echo " error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"name\">Заголовок</label>
            <div class=\"col-lg-6\">
                <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" value=\"";
        // line 13
        if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
        echo $this->getAttribute($_group_, "name");
        echo "\">
            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-lg-6\">
                <input type=\"hidden\" name=\"task\" value=\"update\" />
                <input type=\"hidden\" name=\"group_id\" value=\"";
        // line 19
        if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
        echo $this->getAttribute($_group_, "id");
        echo "\" />
                <button class=\"btn btn-default\" type=\"submit\">Сохранить</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">Отмена</button>
            </div>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "users/views/edit/templates/edit_group.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 19,  45 => 13,  36 => 10,  29 => 7,  21 => 3,  17 => 1,);
    }
}
