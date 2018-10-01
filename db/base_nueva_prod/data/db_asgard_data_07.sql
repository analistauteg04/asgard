--
-- Base de datos: `db_asgard`
--
USE `db_asgard`;

--
-- Volcado de datos para la tabla `usuario`
--


INSERT INTO `usuario` (`usu_id`, `per_id`, `usu_user`, `usu_sha`, `usu_password`, `usu_time_pass`, `usu_session`, `usu_last_login`, `usu_link_activo`, `usu_estado`, `usu_fecha_creacion`, `usu_fecha_modificacion`, `usu_estado_logico`) VALUES
(1, 1, 'dlopez@uteg.edu.ec', 'jkYnLjpgwzse50H4VbKE7zsbvTnC2uIb', '+Y97uXDhL0F9CQaHKKLcbjdmOGUyYTZkZWQxYWYyOGI0ZjhiNzViNDNkM2JkODlkMDMxZGMwYzg1MWM5NjhkMWIxMDI1YzlhY2M3YjUxZTSaXXoLsPecZttR73ENLIgbcsBkgGJ0huoMwIynpIoZv1mEbcqHxwiqBU8ryDMUPNGYoA/M0XhPLYH7dtlD6otV', NULL, NULL, NULL, NULL, '1', '2017-09-28 05:14:00', NULL, '1'),
(2, 2, 'jefedesarrollo@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '2017-09-27 09:02:00', NULL, '1'),
(3, 3, 'analistadesarrollo01@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '2017-09-27 09:02:00', NULL, '1'),
(4, 4, 'analistadesarrollo02@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '2017-09-27 09:02:00', NULL, '1'),
(5, 5, 'analistadesarrollo03@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '2017-09-27 09:02:00', NULL, '1'),
(6, 6, 'abejarano@uteg.edu.ec', 'hXiPmZ2Rw2ZZLMkhZ52MXAyU10jzzDJb', 'sn0ZtNfYI9LMSCKF+IUwDDMzZWJlMjhhMGVjMjQ1NzkwNTU0ZmRiNmEwNzM2YjdkMGYzOGU5MWIxYzk3ZGQxMWQwNDc5NjA3ZjdkZDJmYTH1kLkvd9zBO50mgAsIW9hyruABSo8PbR8kBfi5lYUy8TXHbV/N9qDTlta2ucFge0PxZfhUhvlYtY4Hs/qxKj8h', NULL, NULL, NULL, NULL, '1', '2017-10-25 02:53:00', NULL, '1'),
(7, 7, 'admisiones01@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-05-17 23:20:00', NULL, '1'),
(8, 8, 'admisiones02@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-05-17 23:25:00', NULL, '1'),
(9, 9, 'admisiones03@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-05-17 23:25:00', NULL, '1'),
(10, 10, 'admisiones04@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-05-17 23:25:00', NULL, '1'),
(11, 11, 'admisiones05@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-05-17 23:25:00', NULL, '1'),
(12, 12, 'admisiones06@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-05-17 23:25:00', NULL, '1'),
(13, 13, 'ventasposgrado01@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-05-17 23:25:00', NULL, '1'),
(14, 14, 'ventasposgrado02@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-05-17 23:25:00', NULL, '1'),
(15, 15, 'ventasposgrado03@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-05-17 23:25:00', NULL, '1'),
(16, 16, 'lidercontactcenter@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(17, 17, 'contactcenter01@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(18, 18, 'contactcenter02@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(19, 19, 'contactcenter03@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(20, 20, 'contactcenter04@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(21, 21, 'supervisorcolecturia@uteg.edu.ec', 'rpvwbGDLI7ilrqY_FwySkKJ4jTnDh3Wb', 'at0l/8F1Iql4VdQzARfFZzkxYzE4ODM3OWNmNTVkN2U5OThhODE4YjZjZjZmNDM4MjU0ZWVjYzE5NDFlZWUwOTg5YjU2MjdkNmNjMjczMjnTjulnuDx09CqSNXcAf3Ch6rKAlCnMls6WeVJdq5heXynGF5kJKIUGZrFLnMMGM18ujL4bkh3tGMd1zWbPbsSu', NULL, NULL, NULL, NULL, '1', '2018-01-30 20:13:00', NULL, '1'),
(22, 22, 'colecturia@uteg.edu.ec', '5ZSDLiC_OFlbibkEQ7ILDbUULNJjYpOX', 'EN/O1jrjQgSHZE6w+bd/nzI0MzJiYzFmZmMzNWMyNzRlMzIyZjdlZjdiMWJhYjJkNzkwMDYzNTAwZmFkMzljY2JiZGFmNWQ5MDI5MWI3Nzc1IMolYpiaYr9M2WC5m5c0JWGU5kQqWtB2gqoQ7gaGsJqiyn7F6x3hpOz5AUU0QrLmerh67ejvhUAAow9Pjefb', NULL, NULL, NULL, NULL, '1', '2018-01-30 20:19:00', NULL, '1'),
(23, 23, 'aalcivar@uteg.edu.ec', 'DI8IHwXsfNeFrNwdwI_cSwb_Gu7MmFf4', 'uGiTkVrUkRBXTiO2ktA4WTcwMTI1OWI0MTM4YzYwYjBlNDAyODVmMDA2NmZhZjc0MWNmMmZjNGI2OTdjNzEwYWE2M2RjYmI3ZWYxYzQ1MTSui71RbleQi0pTbykQBgrrfDnwAgJkDbij0mICOqkZK1UGn9stLQKZt4TYXU/lQKW9PVWZ9DfiW5KOPHR67Zov', NULL, NULL, NULL, NULL, '1', '2018-07-22 19:44:00', NULL, '1'),
(24, 24, 'xmosquera@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 23:59:00', NULL, '1'),
(25, 25, 'decanasemipresencial@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-02 15:46:00', NULL, '1'),
(26, 26, 'decanoposgrado@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-02 15:46:00', NULL, '1'),
(27, 27, 'secretariaonline@uteg.edu.ec', 'Zso9HhfUjWAo4oTOqx3dx6bJkab3yOhp', 'VXu9Ab+jhCp7EQLtSjtnPTcwZGM5MjVmODc5MmFlN2I3ZmQ3Nzk3NGNjOWMyZGVjN2NjYWM5OWM3OGZjMzIxNmFlYmVlY2QxMGVjNWNhOWIL04zbRKowoUHAejOfzVcXsbXouO37UTxuNnOeKuWgT+W3IvNSYiGC/l1ej3FB7z/DUzjQXD6p9VR7viiYqYX+', NULL, NULL, NULL, NULL, '1', '2018-03-13 19:24:00', NULL, '1'),
(28, 28, 'ahernandez@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-04-05 23:57:00', NULL, '1'),
(29, 29, 'administradorplataforma@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-04-13 04:06:00', NULL, '1'),
(30, 30, 'daguirre@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(31, 31, 'cvelez@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(32, 32, 'cbarros@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(33, 33, 'kmunoz@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(34, 34, 'gmoran@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(35, 35, 'jhoyos@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(36, 36, 'mviteri@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1'),
(37, 37, 'sgarcia@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '2018-08-01 12:15:00', NULL, '1');

--
-- Volcado de datos para la tabla `empresa_persona`
--
INSERT INTO `empresa_persona` (`eper_id`, `emp_id`, `per_id`, `eper_estado`, `eper_fecha_creacion`, `eper_fecha_modificacion`, `eper_estado_logico`) VALUES
(1, 1, 1, '1', '2017-05-10 23:00:00', NULL, '1'),
(2, 1, 2, '1', '2017-05-10 23:00:00', NULL, '1'),
(3, 1, 3, '1', '2017-05-10 23:00:00', NULL, '1'),
(4, 1, 4, '1', '2017-05-10 23:00:00', NULL, '1'),
(5, 1, 5, '1', '2017-05-10 23:00:00', NULL, '1'),
(6, 1, 6, '1', '2017-05-10 23:00:00', NULL, '1'),
(7, 1, 7, '1', '2017-05-10 23:00:00', NULL, '1'),
(8, 1, 8, '1', '2017-05-10 23:00:00', NULL, '1'),
(9, 1, 9, '1', '2017-05-10 23:00:00', NULL, '1'),
(10, 1, 10, '1', '2017-05-10 23:00:00', NULL, '1'),
(11, 1, 11, '1', '2017-05-10 23:00:00', NULL, '1'),
(12, 1, 12, '1', '2017-05-10 23:00:00', NULL, '1'),
(13, 1, 13, '1', '2017-05-10 23:00:00', NULL, '1'),
(14, 1, 14, '1', '2017-05-10 23:00:00', NULL, '1'),
(15, 1, 15, '1', '2017-05-10 23:00:00', NULL, '1'),
(16, 1, 16, '1', '2017-05-10 23:00:00', NULL, '1'),
(17, 1, 17, '1', '2017-05-10 23:00:00', NULL, '1'),
(18, 1, 18, '1', '2017-05-10 23:00:00', NULL, '1'),
(19, 1, 19, '1', '2017-05-10 23:00:00', NULL, '1'),
(20, 1, 20, '1', '2018-08-01 14:43:07', NULL, '1'),
(21, 1, 21, '1', '2017-05-10 23:00:00', NULL, '1'),
(22, 1, 22, '1', '2017-05-10 23:00:00', NULL, '1'),
(23, 1, 23, '1', '2017-05-10 23:00:00', NULL, '1'),
(24, 1, 24, '1', '2017-05-10 23:00:00', NULL, '1'),
(25, 1, 25, '1', '2017-05-10 23:00:00', NULL, '1'),
(26, 1, 26, '1', '2017-05-10 23:00:00', NULL, '1'),
(27, 1, 27, '1', '2017-05-10 23:00:00', NULL, '1'),
(28, 1, 28, '1', '2018-08-02 00:00:03', NULL, '1'),
(29, 1, 29, '1', '2018-08-02 15:59:11', NULL, '1'),

(30, 1, 30, '1', '2017-05-10 23:00:00', NULL, '1'),
(31, 1, 31, '1', '2017-05-10 23:00:00', NULL, '1'),
(32, 1, 32, '1', '2017-05-10 23:00:00', NULL, '1'),
(33, 1, 33, '1', '2017-05-10 23:00:00', NULL, '1'),
(34, 1, 34, '1', '2018-08-02 00:00:03', NULL, '1'),
(35, 1, 35, '1', '2018-08-02 15:59:11', NULL, '1'),
(36, 1, 36, '1', '2018-08-02 00:00:03', NULL, '1'),
(37, 1, 37, '1', '2018-08-02 15:59:11', NULL, '1');

--
-- Volcado de datos para la tabla `usua_grol_eper`
--
INSERT INTO `usua_grol_eper` (`ugep_id`, `eper_id`, `usu_id`, `grol_id`, `ugep_estado`, `ugep_fecha_creacion`, `ugep_fecha_modificacion`, `ugep_estado_logico`) VALUES
(1, 1, 1, 1, '1', '2017-09-27 14:02:00', NULL, '1'),
(2, 2, 2, 1, '1', '2017-09-27 14:02:00', NULL, '1'),
(3, 3, 3, 1, '1', '2017-09-27 14:02:00', NULL, '1'),
(4, 4, 4, 1, '1', '2017-09-27 14:02:00', NULL, '1'),
(5, 5, 5, 1, '1', '2017-09-27 14:02:00', NULL, '1'),
(6, 6, 6, 3, '1', '2018-10-01 01:04:39', NULL, '1'),
(7, 7, 7, 5, '1', '2018-10-01 00:42:54', NULL, '1'),
(8, 8, 8, 5, '1', '2018-10-01 00:46:26', NULL, '1'),
(9, 9, 9, 5, '1', '2018-10-01 00:47:33', NULL, '1'),
(10, 10, 10, 5, '1', '2018-10-01 00:48:43', NULL, '1'),
(11, 11, 11, 5, '1', '2018-10-01 00:50:52', NULL, '1'),
(12, 12, 12, 5, '1', '2018-10-01 00:52:46', NULL, '1'),
(13, 13, 13, 5, '1', '2018-10-01 00:56:57', NULL, '1'),
(14, 14, 14, 5, '1', '2018-10-01 00:59:26', NULL, '1'),
(15, 15, 15, 5, '1', '2018-10-01 01:00:58', NULL, '1'),
(16, 16, 16, 4, '1', '2018-10-01 00:41:49', NULL, '1'),
(17, 17, 17, 5, '1', '2018-10-01 00:31:16', NULL, '1'),
(18, 18, 18, 5, '1', '2018-10-01 00:33:26', NULL, '1'),
(19, 19, 19, 5, '1', '2018-10-01 00:34:27', NULL, '1'),
(20, 20, 20, 5, '1', '2018-10-01 00:35:32', NULL, '1'),
(21, 21, 21, 11, '1', '2018-10-01 01:11:06', NULL, '1'),
(22, 22, 22, 12, '1', '2018-09-30 22:54:04', NULL, '1'),
(23, 23, 23, 15, '1', '2017-11-07 01:36:00', NULL, '1'),
(24, 24, 24, 19, '1', '2018-10-01 01:20:19', NULL, '1'),
(25, 25, 25, 19, '1', '2018-10-01 01:21:17', NULL, '1'),
(26, 26, 26, 23, '1', '2018-10-01 01:24:46', NULL, '1'),
(27, 27, 27, 18, '1', '2018-04-06 05:01:00', NULL, '1'),
(28, 28, 28, 16, '1', '2018-10-01 03:16:11', NULL, '1'),
(29, 29, 29, 17, '1', '2018-10-01 03:22:54', NULL, '1'),
(30, 30, 30, 20, '1', '2018-10-01 03:28:39', NULL, '1'),
(31, 31, 31, 22, '1', '2018-10-01 03:34:01', NULL, '1'),
(33, 33, 33, 16, '1', '2018-01-30 07:42:00', NULL, '1'),
(34, 34, 34, 17, '1', '2018-03-28 01:18:00', NULL, '1'),
(35, 35, 35, 18, '1', '2018-04-06 05:01:00', NULL, '1'),
(36, 36, 36, 19, '1', '2018-08-02 22:46:00', NULL, '1'),
(37, 37, 37, 19, '1', '2018-08-02 21:04:00', NULL, '1');



