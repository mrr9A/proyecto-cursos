-- CREANDO CURSOS
-- MODALIDAD =  1-online, 2- aula virtual, 3-presencial
-- PLAN DE FORMACION - CONSULTOR DE EXPERIENCIAS
-- INICIALES
-- CURSOS SI CONDIGO Y CON MAS DE UNO NO HAN SIDO ALMACENADOS -- YA HAN SIDO ALAMACENADOS PERO NO SE LES A ASIGNADO SUS CODIGOS EN EL CASO DE LOS
-- ['nombre', 'fecha_inicio', 'fecha_final', 'estado', 'modalidad_id', 'tipo_curso_id', 'codigo','imagen', 'interno_planta'];
-- // TIPO DE CURSOS
--         // Inserción 1 iniciales
--         // Inserción 2 fundamentos
--         // Inserción 3 especialidad
--         // Inserción 4 complementarios
--         // Inserción 5 basico
--         // Inserción 6 avanzadao
--         // Inserción 7 experto

-- Consultor de experiencia - iniciales
INSERT INTO cursos(codigo, nombre, estado, modalidad_id, tipo_curso_id) VALUES
                  ("w-01" ,"introduccion a volkswagen", 1, 1, 1),
                  ("w-33" ,"procesos de ventas volkswagen", 1, 1, 1),
                  ("w-021" ,"long drive", 1, 1, 1),
                  ("0-01" ,"trabajo en equipo", 1, 1, 1),
                  ("w-34" ,"proceso de ventas digital(online booking)", 1, 1, 1),
                  ("w-12" ,"campañas", 1, 1, 1),
                  ("w-31" ,"salesforce ventas", 1, 1, 1),
                  ("w-61" ,"gestión de reclamaciones post venta", 1, 1, 1),
                  ("w-07" ,"oferta comercial post venta", 1, 1, 1),
                  ("0-61" ,"derechos y obligaciones en la prestacion de servicios", 1, 1, 1),
                  ("w-89" ,"procesos de refacciones", 1, 1, 1),
                  ("0-60" ,"procesos de servicio", 1, 1, 1),
                  -- Sin codigo
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id) VALUES
                  ("auto estudios de productos volkswagen", 1, 1, 1),
                  ("introducción al customer journey de post venta", 0, 2, 2),
                  ("calidad e indicadores en la post venta", 0, 2, 2),

-- FUNDAMENTOS
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("vpb004b.0", "bievenida a vw y argumentación en tecnología", 0, 2, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-41","asegurar un contacto digital exitoso", 0, 1, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-42","negociación gerentes", 0, 1, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-37","entrega del auto y fidelización del cliente", 0, 1, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-010","basico post venta", 0, 3, 2);


INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("autoestudios de productos volkswagen", 0, 1, 1);
-- CURSOS CON MAS DE UN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("introducción al customer journey de post venta", 0, 2, 2);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("calidad e indicadores en la post venta", 0, 2, 2);
-- CURSOS CON MAS DE UN CODIGO

INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("marketing de post venta", 0, 2, 3);
-- CURSO CON MAS DE UN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("lidezargo y capital humano", 0, 2, 3);


-- ESPECIALIDAD
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-63", "marketing digital post venta", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-87","mejores prácticas gestión de leads", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-116", "salesforce ventas", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-09","liderazgo y desarrollo de equipos", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-10","capital humano i reclutamiento y seleccion", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-11","capital humano ii entrevista con los empleados", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-109","estrategias de marketing e inventario", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-210","misión 100", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-44","herramientas de gestion", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-115","uso de herramientas de gestion", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-94","costos de la no calidad", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-230","seguimiento constos de la no calidad", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("nuevo","herramientas de solucion de problemas", 0, 3, 3);
-- COMPLEMETARIOS
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-02","gestión del tiempo", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-38","habilidades de ventas", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-03","garantías y cortesías", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-62","juego de la consesionaría electrónico", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-03","inteligencia emocional", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-63","contabilidad en concesionario", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-04","manejo redes sociales", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-64","descripción puestos post venta", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-06","exito en la comunicacion", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-68","sistemas de post venta", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-12","campañas", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-255","tablas de mantenimiento gerentes", 0, 2, 4);
-- FIN DE LA CREACION DE LOS CURSOS  DE CONSULTOR DE EXPERIENCIAS


-- ==============================================================================================
-- PLAN DE FORMACION VOLKSWAGEN - POST VENTA
-- PUESTO - GERENTE DE SERVICIO 

INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-01", "trabajo en equipo", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-07", "oferta comercial post venta", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-60", "procesos de servicio vw", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-83", "apos/averías", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-60", "tablas de mantenimiento", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-90", "reporting garantías", 0, 1, 1);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("productos volkswagen", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-06", "éxito en la comunicacion", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-61", "gestíon de reclamaciones", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-61", "derechos y obligaciones en la prestación de servicios", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-67", "saga/2", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-03", "garantías y cortesías", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-68", "sistemas de post venta", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-89", "proceso de refacciones (manual)", 0, 1, 1);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("proceso de refacciones (video)", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-02","long drive", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-12","campañas", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-62","diss", 0, 1, 1);
-- FUNDAMENTOS
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("vpb004b.0", "bievenida a vw y argumentación en tecnología", 0, 2, 2);
-- CURSOS CON MAS DE UN CODIGO -> YA AGREGADOS ANTERIORMENTE
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("introducción al customer journey de post venta", 0, 2, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("calidad e indicadores en la post venta", 0, 2, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-010","basico post venta", 0, 3, 2);

-- EXPECIALIDAD
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-63","marketing digital post venta", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-09","liderazgo y desarrollo de equipos", 0, 1, 3);
-- CURSO CON MAS DE UN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("gestión de capital humano", 0, 1, 3);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("elsa pro y campañas", 0, 2, 3);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("saga/2 básico", 0, 2, 3);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("diss", 0, 2, 3);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("apos y tablas de mantenimiento", 0, 2, 3);


INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-208","reporting garantías", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-09","contabilidad en el concesionario", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-87","mejores prácticas gestión de leads", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-209","administración del departamento de servicio", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-269","odis", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-003","liderazgo y capital humano práctico", 0, 3, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-005","planeación y organización de servicio", 0, 3, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-042","especial de garantías", 0, 3, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-423","especialidad sistemaas", 0, 3, 3);


-- COMPLEMENTARIOS

INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-37","números de parte de refacciones", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-08","aceites", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-08","aceites", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-13","llantas", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("0-65","reporte post venta vm", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-014","conching", 0, 3, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-219","customer experience post venta", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-267","elsa2 go", 0, 1, 4);
-- CURSO CON MAS DE UN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("saga/2 avanzado", 0, 1, 4);

-- ACTULIZACIONES -> NO HAN SIDO AGREGADOS NO EXISTE TIPO DE CURSO = ACTUALIZACION
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("modúlo 1 de actualizacion IT", 0, 2, 8);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("modúlo 2 de actualizacion IT", 0, 2, 8);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("modúlo 3 de actualizacion IT", 0, 2, 8);

-- FIN DE LA CREACION DE LOS CURSOS  DE -- PLAN DE FORMACION VOLKSWAGEN - POST VENTA
-- PUESTO - GERENTE DE SERVICIO 
-- ==============================================================================================


-- CURSOSOSOS
-- CURSOS SI CONDIGO Y CON MAS DE UNO NO HAN SIDO ALMACENAsDOS -- YA HAN SIDO ALAMACENADOS PERO NO SE LES A ASIGNADO SUS CODIGOS EN EL CASO DE LOS
-- QUE TIENEN MAS DE UN CODIGO
-- CURSOS SIN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("autoestudios de productos volkswagen", 0, 1, 1);
-- CURSOS CON MAS DE UN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("introducción al customer journey de post venta", 0, 2, 2);
INSERT INTO cursos(nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("calidad e indicadores en la post venta", 0, 2, 2);
-- CURSOS CON MAS DE UN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("marketing de post venta", 0, 2, 3);
-- CURSO CON MAS DE UN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("lidezargo y capital humano", 0, 2, 3);

-- INICIALES
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-01","introducción volkswagen", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("0-01", "trabajo en equipo", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES( "w-12", "campañas", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-07", "oferta comercial post venta", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("0-61", "derechos y obligaciones en la prestación de servicios", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-89", "procesos de refacciones", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-32","proceso de ventas volkswagen", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-021","long drive", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-34","proceso de ventas digital(online booking)", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-31","salesforce ventas", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-61","gestión de reclamaciones post venta", 0, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("0-60","procesos de servicio", 0, 1, 1);
-- FUNDAMENTOS
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("vpb004b.0", "bievenida a vw y argumentación en tecnología", 0, 2, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-41","asegurar un contacto digital exitoso", 0, 1, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-42","negociación gerentes", 0, 1, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-37","entrega del auto y fidelización del cliente", 0, 1, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("v-010","basico post venta", 0, 3, 2);
-- ESPECIALIDAD
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-63", "marketing digital post venta", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-87","mejores prácticas gestión de leads", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("v-116", "salesforce ventas", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-09","liderazgo y desarrollo de equipos", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-10","capital humano i reclutamiento y seleccion", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-11","capital humano ii entrevista con los empleados", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("v-109","estrategias de marketing e inventario", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("v-210","misión 100", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-44","herramientas de gestion", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("v-115","uso de herramientas de gestion", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-94","costos de la no calidad", 0, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("v-230","seguimiento constos de la no calidad", 0, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("nuevo","herramientas de solucion de problemas", 0, 3, 3);
-- COMPLEMETARIOS
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("0-02","gestión del tiempo", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-38","habilidades de ventas", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("0-03","garantías y cortesías", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("0-62","juego de la consesionaría electrónico", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-03","inteligencia emocional", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("0-63","contabilidad en concesionario", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-04","manejo redes sociales", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("0-64","descripción puestos post venta", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-06","exito en la comunicacion", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-68","sistemas de post venta", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("w-12","campañas", 0, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id_modalidad, tipo_curso_id)
VALUES("v-255","tablas de mantenimiento gerentes", 0, 2, 4);
-- FIN DE LA CREACION DE LOS CURSOS  DE CONSULTOR DE EXPERIENCIAS


-- ==============================================================================================
-- PLAN DE FORMACION VOLKSWAGEN - POST VENTA
-- PUESTO - GERENTE DE SERVICIO 

INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-11", "trabajo en equipo", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-17", "oferta comercial post venta", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-61", "procesos de servicio vw", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-83", "apos/averías", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-61", "tablas de mantenimiento", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-91", "reporting garantías", 1, 1, 1);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("productos volkswagen", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-16", "éxito en la comunicacion", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-61", "gestíon de reclamaciones", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-61", "derechos y obligaciones en la prestación de servicios", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-67", "saga/2", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-13", "garantías y cortesías", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-68", "sistemas de post venta", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-89", "proceso de refacciones (manual)", 1, 1, 1);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("proceso de refacciones (video)", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-12","long drive", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-12","campañas", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-62","diss", 1, 1, 1);
-- FUNDAMENTOS
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("vpb114b.1", "bievenida a vw y argumentación en tecnología", 1, 2, 2);
-- CURSOS CON MAS DE UN CODIGO -> YA AGREGADOS ANTERIORMENTE
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("introducción al customer journey de post venta", 1, 2, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("calidad e indicadores en la post venta", 1, 2, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-111","basico post venta", 1, 3, 2);

-- EXPECIALIDAD
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-63","marketing digital post venta", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-19","liderazgo y desarrollo de equipos", 1, 1, 3);
-- CURSO CON MAS DE UN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("gestión de capital humano", 1, 1, 3);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("elsa pro y campañas", 1, 2, 3);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("saga/2 básico", 1, 2, 3);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("diss", 1, 2, 3);
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("apos y tablas de mantenimiento", 1, 2, 3);


INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-218","reporting garantías", 1, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-19","contabilidad en el concesionario", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-87","mejores prácticas gestión de leads", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-219","administración del departamento de servicio", 1, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-269","odis", 1, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-113","liderazgo y capital humano práctico", 1, 3, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-115","planeación y organización de servicio", 1, 3, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-142","especial de garantías", 1, 3, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-423","especialidad sistemaas", 1, 3, 3);


-- COMPLEMENTARIOS

INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-37","números de parte de refacciones", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-18","aceites", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-18","aceites", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-13","llantas", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-65","reporte post venta vm", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-114","conching", 1, 3, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-219","customer experience post venta", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-267","elsa2 go", 1, 1, 4);
-- CURSO CON MAS DE UN CODIGO
INSERT INTO cursos(nombre, estado, modalidad_id, tipo_curso_id)
VALUES("saga/2 avanzado", 1, 1, 4);

-- CURSOS SEGUNDO MODELO
-- INICIALES
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-11","introducción volkswagen", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-11", "trabajo en equipo", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES( "w-12", "campañas", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-17", "oferta comercial post venta", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-61", "derechos y obligaciones en la prestación de servicios", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-89", "procesos de refacciones", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-32","proceso de ventas volkswagen", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-121","long drive", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-34","proceso de ventas digital(online booking)", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-31","salesforce ventas", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-61","gestión de reclamaciones post venta", 1, 1, 1);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-61","procesos de servicio", 1, 1, 1);
-- FUNDAMENTOS
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("vpb114b.1", "bievenida a vw y argumentación en tecnología", 1, 2, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-41","asegurar un contacto digital exitoso", 1, 1, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-42","negociación gerentes", 1, 1, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-37","entrega del auto y fidelización del cliente", 1, 1, 2);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-111","basico post venta", 1, 3, 2);
-- ESPECIALIDAD
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-63", "marketing digital post venta", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-87","mejores prácticas gestión de leads", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-116", "salesforce ventas", 1, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-19","liderazgo y desarrollo de equipos", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-11","capital humano i reclutamiento y seleccion", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-11","capital humano ii entrevista con los empleados", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-119","estrategias de marketing e inventario", 1, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-211","misión 111", 1, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-44","herramientas de gestion", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-115","uso de herramientas de gestion", 1, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-94","costos de la no calidad", 1, 1, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-231","seguimiento constos de la no calidad", 1, 2, 3);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("nuevo","herramientas de solucion de problemas", 1, 3, 3);
-- COMPLEMETARIOS
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-12","gestión del tiempo", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-38","habilidades de ventas", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-13","garantías y cortesías", 1, 1, 4);

INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-62","juego de la consesionaría electrónico", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-13","inteligencia emocional", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-63","contabilidad en concesionario", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-14","manejo redes sociales", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("1-64","descripción puestos post venta", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-16","exito en la comunicacion", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-68","sistemas de post venta", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("w-12","campañas", 1, 1, 4);
INSERT INTO cursos(codigo,nombre, estado, modalidad_id, tipo_curso_id)
VALUES("v-255","tablas de mantenimiento gerentes", 1, 2, 4);