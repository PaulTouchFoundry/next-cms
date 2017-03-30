<?php

$pageController = 'Wearenext\CMS\Controllers\PageController';
$pageTypeController = 'Wearenext\CMS\Controllers\PageTypeController';
$blockController = 'Wearenext\CMS\Controllers\BlockController';
$mediaController = 'Wearenext\CMS\Controllers\MediaController';
$userController = 'Wearenext\CMS\Controllers\UserController';
$calloutController = 'Wearenext\CMS\Controllers\CalloutController';
$docController = 'Wearenext\CMS\Controllers\DocsController';

Route::get('/', [ 'uses' => "{$pageController}@index", 'as' => 'cms.index' ]);
Route::get('/page', [ 'uses' => "{$pageController}@index", 'as' => 'cms.page.index' ]);
Route::get('/page/{cmsType}', [ 'uses' => "{$pageController}@view", 'as' => 'cms.page.view' ]);
Route::get('/page/{cmsType}/preview/{id}', [ 'uses' => "{$pageController}@preview", 'as' => 'cms.page.preview' ]);
Route::get('/page/{cmsType}/create', [ 'uses' => "{$pageController}@create", 'as' => 'cms.page.create' ]);
Route::get('/page/{cmsType}/{cmsPage}/edit', [ 'uses' => "{$pageController}@edit", 'as' => 'cms.page.edit' ]);
Route::post('/page/{cmsType}/create', [ 'uses' => "{$pageController}@save", 'as' => 'cms.page.save' ]);

Route::get('/page/{cmsType}/{cmsPage}/publish', [ 'uses' => "{$pageController}@publish", 'as' => 'cms.page.publish' ]);
Route::get('/page/{cmsType}/{cmsPage}/unpublish', [ 'uses' => "{$pageController}@unpublish", 'as' => 'cms.page.unpublish' ]);

Route::post('/page/{cmsType}/{cmsPage}/edit', [ 'uses' => "{$pageController}@update", 'as' => 'cms.page.update' ]);
Route::post('/page/{cmsType}/{cmsPage}/delete', [ 'uses' => "{$pageController}@delete", 'as' => 'cms.page.delete' ]);

Route::get('/page/{cmsType}/{cmsPage}/blocks', [ 'uses' => "{$blockController}@index", 'as' => 'cms.block.index' ]);
Route::post('/page/{cmsType}/{cmsPage}/blocks', [ 'uses' => "{$blockController}@update", 'as' => 'cms.block.update' ]);

Route::get('/page/{cmsType}/{cmsPage}/text_block', [ 'uses' => "{$blockController}@createTextBlock", 'as' => 'cms.block.create_text_block' ]);
Route::post('/page/{cmsType}/{cmsPage}/text_block', [ 'uses' => "{$blockController}@saveTextBlock", 'as' => 'cms.block.save_text_block' ]);

Route::get('/page/{cmsType}/{cmsPage}/icon_list_block', [ 'uses' => "{$blockController}@createIconListBlock", 'as' => 'cms.block.create_icon_list_block' ]);
Route::post('/page/{cmsType}/{cmsPage}/icon_list_block', [ 'uses' => "{$blockController}@saveIconListBlock", 'as' => 'cms.block.save_icon_list_block' ]);

Route::get('/page/{cmsType}/{cmsPage}/media_block', [ 'uses' => "{$blockController}@createMediaBlock", 'as' => 'cms.block.create_media_image_block' ]);
Route::post('/page/{cmsType}/{cmsPage}/media_block', [ 'uses' => "{$blockController}@saveMediaBlock", 'as' => 'cms.block.save_media_image_block' ]);

Route::get('/page/{cmsType}/{cmsPage}/featured_block', [ 'uses' => "{$blockController}@createFeaturedBlock", 'as' => 'cms.block.create_featured_block' ]);
Route::post('/page/{cmsType}/{cmsPage}/featured_block', [ 'uses' => "{$blockController}@saveFeaturedBlock", 'as' => 'cms.block.save_featured_block' ]);

Route::get('/page/{cmsType}/{cmsPage}/embed_block', [ 'uses' => "{$blockController}@createEmbedBlock", 'as' => 'cms.block.create_embed_block' ]);
Route::post('/page/{cmsType}/{cmsPage}/embed_block', [ 'uses' => "{$blockController}@saveEmbedBlock", 'as' => 'cms.block.save_embed_block' ]);

Route::get('/page/{cmsType}/{cmsPage}/table_block', [ 'uses' => "{$blockController}@createTableBlock", 'as' => 'cms.block.create_table_block' ]);
Route::post('/page/{cmsType}/{cmsPage}/table_block', [ 'uses' => "{$blockController}@saveTableBlock", 'as' => 'cms.block.save_table_block' ]);

Route::get('/block/{cmsBlock}/edit', [ 'uses' => "{$blockController}@editBlock", 'as' => 'cms.block.edit_block' ]);
Route::post('/block/{cmsBlock}/edit', [ 'uses' => "{$blockController}@updateBlock", 'as' => 'cms.block.update_block' ]);
Route::post('/block/{cmsBlock}/delete', [ 'uses' => "{$blockController}@deleteBlock", 'as' => 'cms.block.delete_block' ]);

Route::get('/pagetype', [ 'uses' => "{$pageTypeController}@view", 'as' => 'cms.pagetype.view' ]);
Route::get('/pagetype/create', [ 'uses' => "{$pageTypeController}@create", 'as' => 'cms.pagetype.create' ]);
Route::get('/pagetype/{cmsPageType}/edit', [ 'uses' => "{$pageTypeController}@edit", 'as' => 'cms.pagetype.edit' ]);
Route::post('/pagetype/create', [ 'uses' => "{$pageTypeController}@save", 'as' => 'cms.pagetype.save' ]);
Route::post('/pagetype/{cmsPageType}/edit', [ 'uses' => "{$pageTypeController}@update", 'as' => 'cms.pagetype.update' ]);
Route::post('/pagetype/{cmsPageType}/delete', [ 'uses' => "{$pageTypeController}@delete", 'as' => 'cms.pagetype.delete' ]);

Route::get('/media/edit/{tag}', [ 'uses' => "{$mediaController}@edit", 'as' => 'cms.media.edit' ]);
Route::post('/media/edit', [ 'uses' => "{$mediaController}@update", 'as' => 'cms.media.update' ]);

Route::get('/user/login', [ 'uses' => "{$userController}@portal", 'as' => 'cms.user.portal' ]);
Route::post('/user/login', [ 'uses' => "{$userController}@login", 'as' => 'cms.user.login' ]);
Route::get('/user/logout', [ 'uses' => "{$userController}@logout", 'as' => 'cms.user.logout' ]);
Route::get('/user', [ 'uses' => "{$userController}@index", 'as' => 'cms.user.index' ]);
Route::get('/user/create', [ 'uses' => "{$userController}@create", 'as' => 'cms.user.create' ]);
Route::get('/user/{cmsUser}/edit', [ 'uses' => "{$userController}@edit", 'as' => 'cms.user.edit' ]);
Route::post('/user/create', [ 'uses' => "{$userController}@save", 'as' => 'cms.user.save' ]);
Route::post('/user/{cmsUser}/edit', [ 'uses' => "{$userController}@update", 'as' => 'cms.user.update' ]);
Route::post('/user/{cmsUser}/delete', [ 'uses' => "{$userController}@delete", 'as' => 'cms.user.delete' ]);
Route::get('/user/{id}/restore', [ 'uses' => "{$userController}@restore", 'as' => 'cms.user.restore' ]);

Route::get('/page/{cmsType}/{cmsPage}/callout', [ 'uses' => "{$calloutController}@create", 'as' => 'cms.callout.create' ]);
Route::post('/page/{cmsType}/{cmsPage}/callout', [ 'uses' => "{$calloutController}@save", 'as' => 'cms.callout.save' ]);
Route::get('/page/{cmsType}/{cmsPage}/{cmsCallout}/edit', [ 'uses' => "{$calloutController}@edit", 'as' => 'cms.callout.edit' ]);
Route::post('/page/{cmsType}/{cmsPage}/{cmsCallout}/edit', [ 'uses' => "{$calloutController}@update", 'as' => 'cms.callout.update' ]);
Route::post('/page/{cmsType}/{cmsPage}/{cmsCallout}/delete', [ 'uses' => "{$calloutController}@delete", 'as' => 'cms.callout.delete' ]);

Route::get('/docs', [ 'uses' => "{$docController}@index", 'as' => 'cms.doc.index' ]);
Route::get('/docs/{id}/view', [ 'uses' => "{$docController}@view", 'as' => 'cms.doc.view' ]);
Route::get('/docs/{id}/{hash}/delete', [ 'uses' => "{$docController}@delete", 'as' => 'cms.doc.delete' ]);
Route::get('/docs/upload', [ 'uses' => "{$docController}@getUpload", 'as' => 'cms.doc.upload' ]);
Route::post('/docs/upload', [ 'uses' => "{$docController}@postUpload", 'as' => 'cms.doc.upload_post' ]);

Route::post('/docs/add-to-fund-page', [ 'uses' => "{$docController}@addDocumentToPage", 'as' => 'cms.doc.add_to_fund_page' ]);
