<?php
session_start();
//error_reporting(E_ALL ^ E_NOTICE);

$con = mysqli_connect('localhost','root','root','gameshar_gsr');

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

date_default_timezone_set('Australia/Brisbane');

include_once("geoplugin.php");
include_once("perms.php");
include_once("tokengen.php");

/* Prepared Statements */
$query_user_info = "SELECT id, username, firstname, lastname, showname, xbox, playstation, steam, console, game, quote, biography, rank, since, town, country, website, facebook, twitter, googleplus, level, picture, badges, favourites, friends, clan, clantime, cover_pic FROM tbl_accounts WHERE username = ?";
$query_user_rank = "SELECT name FROM tbl_ranks WHERE id = ?";
$query_user_exp = "SELECT timestamp, url FROM tbl_xp_log WHERE username = ? AND action_type = ?";
$query_user_friend = "SELECT showname, username, firstname, lastname, picture FROM tbl_accounts WHERE id = ?";
$query_user_badges = "SELECT name, file FROM tbl_badges WHERE id = ?";
$query_user_art_info = "SELECT id, views, bites FROM tbl_review WHERE authuser = ? AND alpha_approved = 'true' UNION SELECT id, views, bites FROM tbl_guide WHERE authuser = ? AND alpha_approved = 'true' UNION SELECT id, views, bites FROM tbl_news WHERE authuser = ? AND alpha_approved = 'true' UNION SELECT id, views, bites FROM tbl_opinion WHERE authuser = ? AND alpha_approved = 'true'";
$query_add_friend = "SELECT id FROM tbl_requests WHERE requestee = ? AND requester = ?";
$query_request_friend = "INSERT INTO tbl_requests (requester, requestee) VALUES (?, ?)";
$query_user_status = "SELECT username, status, date_status, likes FROM tbl_status WHERE username = ?";
?>
