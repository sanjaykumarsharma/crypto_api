<?php

$app->post('/login','LoginService:login');

$app->get('/tags','TagsService:getTags');
$app->post('/tags','TagsService:createTag');
$app->put('/tags','TagsService:updateTag');
$app->delete('/tags/:{id}','TagsService:deleteTag');


//$app->post('/post','LoginService:indexPost');

//$app->get('/posts','TelecomeService:getPosts');
//$app->get('/lte','LteService:getFourGPosts');


