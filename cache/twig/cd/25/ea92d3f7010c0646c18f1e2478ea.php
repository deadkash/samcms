<?php

/* gallery/views/list/templates/session_list.twig */
class __TwigTemplate_cd25ea92d3f7010c0646c18f1e2478ea extends Twig_Template
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
        echo $this->getAttribute($_ln_, "gallery_sessions");
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
        if (isset($context["add"])) { $_add_ = $context["add"]; } else { $_add_ = null; }
        echo $_add_;
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_add");
        echo "</a>
                <button name=\"task\" value=\"delete\" type=\"submit\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-trash\"></i>&nbsp;";
        // line 7
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_delete");
        echo "</button>
            </div>
            <div style=\"clear: both;\"></div>
        </div>
        <div class=\"menus\">
            ";
        // line 12
        if (isset($context["sessions"])) { $_sessions_ = $context["sessions"]; } else { $_sessions_ = null; }
        if ($_sessions_) {
            // line 13
            echo "            <table class=\"table table-striped\">
                <tr>
                    <th class=\"th30\"><input type=\"checkbox\" class=\"check-all\"></th>
                    <th class=\"th30\">ID</th>
                    <th>";
            // line 17
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "gallery_name");
            echo "</th>
                    <th class=\"th150\"></th>
                </tr>
                ";
            // line 20
            if (isset($context["sessions"])) { $_sessions_ = $context["sessions"]; } else { $_sessions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_sessions_);
            foreach ($context['_seq'] as $context["_key"] => $context["session"]) {
                // line 21
                echo "                    <tr>
                        <td><input type=\"checkbox\" class=\"check-item\" name=\"item[]\" value=\"";
                // line 22
                if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
                echo $this->getAttribute($_session_, "id");
                echo "\"></td>
                        <td>";
                // line 23
                if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
                echo $this->getAttribute($_session_, "id");
                echo "</td>
                        <td><a href=\"";
                // line 24
                if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
                echo $this->getAttribute($_session_, "edit");
                echo "\">";
                if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
                echo $this->getAttribute($_session_, "title");
                echo "</a></td>
                        <td class=\"btnset\">
                            <div class=\"btn-group\">
                                <a href=\"";
                // line 27
                if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
                echo $this->getAttribute($_session_, "edit");
                echo "\" title=\"";
                if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                echo $this->getAttribute($_ln_, "gallery_edit");
                echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-pencil\"></i></a>
                                <a href=\"";
                // line 28
                if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
                echo $this->getAttribute($_session_, "sizes");
                echo "\" title=\"";
                if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                echo $this->getAttribute($_ln_, "gallery_session_sizes");
                echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-resize-full\"></i></a>
                                <a href=\"";
                // line 29
                if (isset($context["session"])) { $_session_ = $context["session"]; } else { $_session_ = null; }
                echo $this->getAttribute($_session_, "photos");
                echo "\" title=\"";
                if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                echo $this->getAttribute($_ln_, "gallery_session_photos");
                echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-picture\"></i></a>
                            </div>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['session'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 34
            echo "            </table>
            ";
        } else {
            // line 36
            echo "            <p>";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "gallery_no_sessions");
            echo "</p>
            ";
        }
        // line 38
        echo "        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "gallery/views/list/templates/session_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 38,  128 => 36,  124 => 34,  109 => 29,  101 => 28,  93 => 27,  83 => 24,  78 => 23,  73 => 22,  70 => 21,  65 => 20,  58 => 17,  52 => 13,  49 => 12,  40 => 7,  32 => 6,  25 => 3,  20 => 2,  17 => 1,);
    }
}
