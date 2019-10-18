<?php

    namespace Adapt\Acf;

    use Adapt\Acf\Field\Boolean;
    use Adapt\Acf\Field\DateTime;
    use Adapt\Acf\Field\File;
    use Adapt\Acf\Field\Gallery;
    use Adapt\Acf\Field\Image;
    use Adapt\Acf\Field\PageLink;
    use Adapt\Acf\Field\PostObject;
    use Adapt\Acf\Field\Repeater;
    use Adapt\Acf\Field\FlexibleContent;
    use Adapt\Acf\Field\Select;
    use Adapt\Acf\Field\Term;
    use Adapt\Acf\Field\Text;
    use Adapt\Acf\Field\User;
    use Corcel\Model;
    use Illuminate\Support\Collection;

    /**
     * Class FieldFactory.
     *
     * @author Junior Grossi <juniorgro@gmail.com>
     */
    class FieldFactory
    {
        private function __construct()
        {
        }

        /**
         * @param  string  $name
         * @param  Post  $post
         * @param  null|string  $type
         *
         * @return FieldInterface|Collection|string
         */
        public static function make($name, Model $post, $type = null)
        {
            if (null === $type) {
                $fakeText = new Text($post);
                $key = $fakeText->fetchFieldKey($name);

                if ($key === null) { // Field does not exist
                    return null;
                }

                $type = $fakeText->fetchFieldType($key);
            }


            switch ($type) {
                case 'text':
                case 'textarea':
                case 'number':
                case 'email':
                case 'url':
                case 'link':
                case 'password':
                case 'wysiwyg':
                case 'editor':
                case 'oembed':
                case 'embed':
                case 'color_picker':
                case 'select':
                case 'checkbox':
                case 'radio':
                    $field = new Text($post);
                    break;
                case 'image':
                case 'img':
                    $field = new Image($post);
                    break;
                case 'file':
                    $field = new File($post);
                    break;
                case 'gallery':
                    $field = new Gallery($post);
                    break;
                case 'true_false':
                case 'boolean':
                    $field = new Boolean($post);
                    break;
                case 'post_object':
                case 'post':
                case 'relationship':
                    $field = new PostObject($post);
                    break;
                case 'page_link':
                    $field = new PageLink($post);
                    break;
                case 'taxonomy':
                case 'term':
                    $field = new Term($post);
                    break;
                case 'user':
                    $field = new User($post);
                    break;
                case 'date_picker':
                case 'date_time_picker':
                case 'time_picker':
                    $field = new DateTime($post);
                    break;
                case 'repeater':
                    $field = new Repeater($post);
                    break;
                case 'flexible_content':
                    $field = new FlexibleContent($post);
                    break;
                default:
                    return null;
            }

            $field->process($name);

            return $field;
        }
    }
