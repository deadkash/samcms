<?php

/* editors/editor/template.twig */
class __TwigTemplate_2417547f6a00c0f9a4b439acf2ea8940 extends Twig_Template
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
        echo "<script type=\"text/javascript\">
    tinymce.init({
        selector: \"#";
        // line 3
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\",
        language : \"ru\",
        theme: \"modern\",
        plugins: [
            \"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker\",
            \"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking\",
            \"save table contextmenu directionality emoticons template paste textcolor\"
        ],
        toolbar1: \"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image\",
        toolbar2: \"print preview media | forecolor backcolor emoticons\",
        image_advtab: true,
        height: ";
        // line 14
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        if ($this->getAttribute($_param_, "height")) {
            if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
            echo $this->getAttribute($_param_, "height");
        } else {
            echo "500";
        }
        // line 15
        echo "    });
</script>
<textarea name=\"";
        // line 17
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" id=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" class=\"wysiwyg\" >";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "default");
        echo "</textarea>";
    }

    public function getTemplateName()
    {
        return "editors/editor/template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 17,  84 => 26,  74 => 23,  63 => 19,  55 => 18,  44 => 15,  21 => 3,  54 => 6,  36 => 14,  31 => 3,  26 => 4,  17 => 1,);
    }
}
