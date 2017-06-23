<?php

namespace ObjectiveWP\Framework\Media;
/**
 * Upload Attachments to the media library
 * @package LouisvilleGeek\PluginName\Media
 */
class AttachmentUploader
{
    /**
     * Upload an image to the media library
     * @param string $image_url The full path or url of the image to upload
     * @param int $authorId The id of the author for the attachment
     * @return int|\WP_Error The attachment id on success or an error object on failure
     */
    public function uploadImage($image_url, $authorId = 1) {
        $upload_dir = wp_upload_dir();
        $image_data = file_get_contents($image_url);
        $filename = basename($image_url);
        if (wp_mkdir_p($upload_dir['path']))
            $file = $upload_dir['path'] . '/' . $filename;
        else
            $file = $upload_dir['basedir'] . '/' . $filename;
        file_put_contents($file, $image_data);

        $wp_fileType = wp_check_filetype($filename, null);
        $attachment = array(
            'post_mime_type' => $wp_fileType['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => $authorId
        );
        $attach_id = wp_insert_attachment($attachment, $file);
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
        wp_update_attachment_metadata($attach_id, $attach_data);
        return $attach_id;
    }
}