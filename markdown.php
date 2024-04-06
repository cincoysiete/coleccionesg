<?php
class MarkdownInterpreter {
    // Función para convertir texto en Markdown a HTML
    public static function toHTML($markdown) {
        // Aplicar conversiones de Markdown a HTML
        // $markdown = self::convertTables($markdown);
        $markdown = self::convertHeaders($markdown);
        $markdown = self::convertBoldAndItalic($markdown);
        $markdown = self::convertLists($markdown);
        $markdown = self::convertLinks($markdown);
        // Agregar más conversiones según sea necesario
        // $markdown = str_replace('&lt;', '<', $markdown);
        // $markdown = str_replace('&gt;', '>', $markdown);        
        return $markdown;
    }
    
    // private static function convertTables($markdown) {
        // Expresión regular para detectar tablas en Markdown
    //     $markdown = preg_replace_callback('/^\|(.+)\|\s*\n\|(.+)\|\s*\n\|?( *[-:]+)([-| :]*)\|?\s*\n((?:\|.*\|?\s*\n)+)/m', function($matches) {
    //         $header = array_map('trim', explode('|', $matches[1]));
    //         $aligns = array_map('trim', explode('|', $matches[3]));
    //         $contentRows = explode("\n", trim($matches[5]));
    //         $html = '<table>';
    //         $html .= '<thead><tr>';
    //         foreach ($header as $index => $col) {
    //             $alignment = isset($aligns[$index]) ? strtolower(trim($aligns[$index])) : '';
    //             $tag = $index === count($header) - 1 ? 'th>' : 'th';
    //             $html .= "<$tag style='text-align: $alignment'>$col</$tag>";
    //         }
    //         $html .= '</tr></thead>';
    //         $html .= '<tbody>';
    //         foreach ($contentRows as $row) {
    //             $cells = array_map('trim', explode('|', $row));
    //             $html .= '<tr>';
    //             foreach ($cells as $index => $cell) {
    //                 $tag = $index === count($header) - 1 ? 'td>' : 'td';
    //                 $html .= "<$tag>$cell</$tag>";
    //             }
    //             $html .= '</tr>';
    //         }
    //         $html .= '</tbody>';
    //         $html .= '</table>';
    //         return $html;
    //     }, $markdown);
        
    //     return $markdown;
    // }
    
    // Función para convertir encabezados (#, ##, ###, etc.) a HTML
    private static function convertHeaders($markdown) {
        $markdown = preg_replace('/^###+ (.+)$/m', '<h3>$1</h3>', $markdown);
        $markdown = preg_replace('/^##+ (.+)$/m', '<h2>$1</h2>', $markdown);
        $markdown = preg_replace('/^#+ (.+)$/m', '<h1>$1</h1>', $markdown);
        // Puedes añadir más niveles de encabezados según sea necesario
        
        return $markdown;
    }
    
    // Función para convertir texto en negrita y cursiva a HTML
    private static function convertBoldAndItalic($markdown) {
        $markdown = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $markdown);
        $markdown = preg_replace('/\*(.*?)\*/s', '<em>$1</em>', $markdown);
        
        return $markdown;
    }
    
    // Función para convertir listas a HTML
    private static function convertLists($markdown) {
        // Convertir listas ordenadas
        $markdown = preg_replace('/^(\d+\..+)$/m', '<ol><li>$1</li></ol>', $markdown);
        
        // Convertir listas sin orden
        $markdown = preg_replace('/^(\*.+)$/m', '<ul><li>$1</li></ul>', $markdown);
        
        return $markdown;
    }
    
    // Función para convertir enlaces a HTML
    private static function convertLinks($markdown) {
        $markdown = preg_replace('/\[([^\]]+)\]\(([^)]+)\)/', '<a href="$2">$1</a>', $markdown);
        
        return $markdown;
    }

}

?>
