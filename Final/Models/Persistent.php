<?php
namespace Models;

interface Persistent {
    function ownCloseConnection();
    function ownBeginTransaction();
    function endTransaction($success);
    function runQuery($sql, $params = []);
}
