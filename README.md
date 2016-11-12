# OlhoNoLixo2

Antes de iniciar o projeto é necessário copiar a pasta library do Zend para o nosso computador, mais precisamente para a pasta do servidor PHP.
Aqui estou utilizando o xampp. Eu criei uma pasta chamada apps e colei a pasta library lá.

C:\xampp\apps\library

Depois disso vamos colocar no include_path do arquivo php.ini o caminho para a biblioteca do Zend Framework.
Basta acessar a pasta C:\xampp\php e procurar o arquivo php.ini, vá até a linha com o comando include_path e acrescente o caminho da biblioteca Zend que foi copiado para o a pasta apps.

Include_path = “C:\xampp\php\PEAR;C:\xampp\apps\library”

Para acessar o projeto pelo navegador, basta inicializar o servidor e digitar no navegador:

http://localhost/OlhoNoLixo2/TP_Zend_TEI/public/


