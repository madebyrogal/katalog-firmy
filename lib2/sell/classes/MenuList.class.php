<?php

class MenuList
{
    /**
     * Tworzy liste (uwaga, nie dodajie na poczatku <ul> i na ko�cu </ul>, to trzeba doda� w komponencie)
     * $object - obiekt danej galezi z menu, wyciagniety przez getTree()->fetchRoot()
     * $routingName - nazwa z routing.yml eg. '@artcategory_show'
     * $idName - nazwa klucza podstawowego eg. 'category_id'
     */
    static function renderList($object, $routingName, $idName)
    {
        $menu = '';
        if($object->getIsPublic() == true)
        {
            //$url = url_for($routingName.'?'.$idName.'='.$object[$idName]);    //XXX Stare - zalezy od category_id - nie mozna zmienic routingu
            $url = url_for($routingName,$object);   //XXX Nowe - routing jest anonimowy i niezależny od parametrow
            //otwieranie 'li'
            $menu .= sprintf('<li><a href="%s" title="%s">%s</a>', $url, $object['name'], $object['name']);
        }

        //jesli aktualna kategoria ma podmenu
        if ( $object->getNode()->hasChildren())
        {
            $menu .= sprintf("<ul>\n"); //utworzenie podmenu
            foreach($object->getNode()->getChildren() as $child)
            {
                $menu .= MenuList::renderList($child, $routingName, $idName); //rekurencja
            }
            $menu .= sprintf("</ul>\n"); //zamykanie podmenu
        }
        $menu .= sprintf("</li>\n"); //zamykanie 'li'

        return $menu;
    }

}