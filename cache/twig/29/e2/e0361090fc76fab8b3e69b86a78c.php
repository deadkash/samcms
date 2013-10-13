<?php

/* gallery/views/resize/templates/resize.twig */
class __TwigTemplate_29e2e0361090fc76fab8b3e69b86a78c extends Twig_Template
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
        echo $this->getAttribute($_ln_, "gallery_resize");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\" >
        <script type=\"text/javascript\">
            \$(document).ready(function(){
            ";
        // line 6
        if (isset($context["sizes"])) { $_sizes_ = $context["sizes"]; } else { $_sizes_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_sizes_);
        foreach ($context['_seq'] as $context["_key"] => $context["size"]) {
            // line 7
            echo "
                \$('#target_";
            // line 8
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "').Jcrop({
                    bgFade:     true,
                    bgOpacity: .2,
                    allowResize: true,
                    setSelect: [ 0, 0, ";
            // line 12
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "width");
            echo ", ";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "height");
            echo " ],
                    onSelect: updateCoords_";
            // line 13
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo ",
                    minSize: [ ";
            // line 14
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "width");
            echo ", ";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "height");
            echo " ],
                    maxSize: [ ";
            // line 15
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "width");
            echo ", ";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "height");
            echo " ]
                });

                function updateCoords_";
            // line 18
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "(c) {
                    \$('#size_";
            // line 19
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_x').val(c.x);
                    \$('#size_";
            // line 20
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_y').val(c.y);
                    \$('#size_";
            // line 21
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_w').val(c.w);
                    \$('#size_";
            // line 22
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_h').val(c.h);
                    \$('#size_";
            // line 23
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_ow').val(\$('#target_";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "').width());
                    \$('#size_";
            // line 24
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_oh').val(\$('#target_";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "').height());
                }
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['size'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 27
        echo "            });
        </script>
        ";
        // line 29
        if (isset($context["sizes"])) { $_sizes_ = $context["sizes"]; } else { $_sizes_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_sizes_);
        foreach ($context['_seq'] as $context["_key"] => $context["size"]) {
            // line 30
            echo "        <div style=\"margin-bottom: 50px;\">
            <h3>";
            // line 31
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "title");
            echo " ";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "width");
            echo " x ";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "height");
            echo "</h3>
            <img src=\"";
            // line 32
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo $this->getAttribute($_image_, "image");
            echo "\" alt=\"\" id=\"target_";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "\" style=\"width: 970px;\" />
            <input type=\"hidden\" id=\"size_";
            // line 33
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_x\" name=\"size_";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_x\" value=\"\" />
            <input type=\"hidden\" id=\"size_";
            // line 34
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_y\" name=\"size_";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_y\" value=\"\" />
            <input type=\"hidden\" id=\"size_";
            // line 35
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_w\" name=\"size_";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_w\" value=\"\" />
            <input type=\"hidden\" id=\"size_";
            // line 36
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_h\" name=\"size_";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_h\" value=\"\" />
            <input type=\"hidden\" id=\"size_";
            // line 37
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_ow\" name=\"size_";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_ow\" value=\"\" />
            <input type=\"hidden\" id=\"size_";
            // line 38
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_oh\" name=\"size_";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo $this->getAttribute($_size_, "id");
            echo "_oh\" value=\"\" />
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['size'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 41
        echo "        <input type=\"hidden\" name=\"task\" value=\"resize\" />
        <input type=\"hidden\" name=\"session_id\" value=\"";
        // line 42
        if (isset($context["session_id"])) { $_session_id_ = $context["session_id"]; } else { $_session_id_ = null; }
        echo $_session_id_;
        echo "\" />
        <input type=\"hidden\" name=\"image_id\" value=\"";
        // line 43
        if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
        echo $this->getAttribute($_image_, "id");
        echo "\"/>
        <button class=\"btn btn-default\" type=\"submit\">";
        // line 44
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_save");
        echo "</button>
        <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 45
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_cancel");
        echo "</button>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "gallery/views/resize/templates/resize.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  227 => 45,  222 => 44,  217 => 43,  212 => 42,  209 => 41,  196 => 38,  188 => 37,  180 => 36,  172 => 35,  164 => 34,  156 => 33,  148 => 32,  137 => 31,  134 => 30,  129 => 29,  125 => 27,  112 => 24,  104 => 23,  99 => 22,  94 => 21,  89 => 20,  84 => 19,  79 => 18,  69 => 15,  61 => 14,  56 => 13,  48 => 12,  40 => 8,  37 => 7,  32 => 6,  25 => 3,  20 => 2,  17 => 1,);
    }
}
