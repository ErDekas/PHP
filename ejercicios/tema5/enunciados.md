1. Abrir fichero de texto para lectura
Crea un script para abrir un fichero de texto para lectura. 

Debes de asegurarte que el fichero existe y en caso contrario mostrar un mensaje de error. Pon dos ejemplos, con un fichero que existe y con otro que no existe.

2. Lectura carácter a carácter
Recorrer un fichero de texto carácter a carácter y mostrar su contenido. Usa fgetc()

3. Fichero de texto con fscanf()
Sea el siguiente fichero: matriz.php.

Se pide:

  Recorrer el  fichero con fscanf() de las dos maneras posibles mostrando su contenido
  antes de empezar la segunda vuelta sitúa el indicador de posición de nuevo al principio del fichero usando rewind()


4. Otras funciones
Analiza el siguiente script de ejemplo y explica qué hace.

5. Manipular archivos


Crea un fichero de texto con varias líneas

 Ábrelo en modo escritura.

Lee su contenido con fgets() y muestra el contenido.

Cierra el archivo.

Escribe dentro de ese archivo un nuevo texto, recuerda que ahora no tendrá que estar abierto en modo lectura.

Copia ese fichero de texto en el mismo directorio con otro nombre.

Renombra el archivo de texto anterior.

Elimina este último archivo.

6. Subir fichero
Seleccionar un fichero usando un formulario y subirlo al servidor.

El tamaño del fichero no debe superar 256 *1024

Se precisa crear la carpeta "subidos" para que la siguiente solución sea válida:

7. Crear y borrar directorios
Crear un directorio o carpeta si no existe.

Sube algún archivo a esta carpeta.

Usa opendir() para abrir un gestor de directorio que nos permita mostrar todos los archivos que hay en esa carpeta.

8. Sube imágenes
Realiza un formulario que nos permita subir imágenes al servidor.

Los ficheros con las imágenes se guardarán en una carpeta especifica para ello llamada "images".

Cada vez que se suba una imagen se mostrarán las imágenes que hay en dicha carpeta.

9. Ficheros XML
Ejercicio resuelto en clase

En esta prácticas :

Se leerá el contenido de un fichero XML
Se seleccionará un elemento con xpath
Se validará un fichero xml con un esquema xsd
Los archivos necesarios para estos ejercicios prácticos son:

empleados
departamentos

10. Uso básico SimpleXML
Consulta el manual y los ejemplos de uso básico de SimpleXML

11. XML añadiendo atributos e hijos
Añade en el fichero de empleados el teléfono y el código postal de cada uno de ellos.

¿Puedes introducir estos datos desde un formulario?

12. CONSEJO
A la hora de mezclar PHP con HTML, es mejor y más seguro frente a posibles inyecciones de código de tipo XSS incrustar el PHP dentro del HTML, es decir, abrir y cerrar las etiquetas de PHP en vez de hacer "echos" para el HTML.

Repasa la sintaxis alternativa.