<?php
namespace SlimSEO\Migration;

use AIOSEO\Plugin\Common;

class AIOSEO extends Replacer {
	private $post;
	private $image;

	public function before_replace_post( $post_id ) {
		$this->post  = get_post( $post_id );
		$this->image = new Common\Social\Image();
		set_current_screen( 'settings_page_slim-seo' ); // Fix undefined get_current_screen from AIOSEO.
	}

	public function get_post_title( $post_id ) {
		$title    = new Common\Meta\Title;
		$metaData = aioseo()->meta->metaData->getMetaData( $this->post );

		return empty( $metaData->title ) ? null : $title->helpers->prepare( $metaData->title, $post_id );
	}

	public function get_post_description( $post_id ) {
		$description = new Common\Meta\Description;
		$metaData    = aioseo()->meta->metaData->getMetaData( $this->post );

		return empty( $metaData->description ) ? null : $description->helpers->prepare( $metaData->description, $post_id, false, false );
	}

	public function get_post_facebook_image( $post_id ) {
		$metaData = aioseo()->meta->metaData->getMetaData( $this->post );
		$image = '';
		if ( ! empty( $metaData ) ) {
			$imageSource = ! empty( $metaData->og_image_type ) && 'default' !== $metaData->og_image_type
				? $metaData->og_image_type
				: aioseo()->options->social->facebook->general->defaultImageSourcePosts;
			$image = $this->getImage( 'facebook', $imageSource, $this->post );
		}
		if ( $image ) {
			return is_array( $image ) ? $image[0] : $image;
		}
		return '';
	}

	public function get_post_twitter_image( $post_id ) {
		$metaData = aioseo()->meta->metaData->getMetaData( $this->post );

		if ( ! empty( $metaData->twitter_use_og ) ) {
			return $this->get_post_facebook_image( $post_id );
		}

		$image = '';
		if ( ! empty( $metaData ) ) {
			$imageSource = ! empty( $metaData->twitter_image_type ) && 'default' !== $metaData->twitter_image_type
				? $metaData->twitter_image_type
				: aioseo()->options->social->twitter->general->defaultImageSourcePosts;
			$image = $this->getImage( 'twitter', $imageSource, $this->post );
		}

		$image = $image ? $image : $this->get_post_facebook_image( $post_id );
		if ( $image ) {
			return is_array( $image ) ? $image[0] : $image;
		}
		return '';
	}

	public function get_post_noindex( $post_id ) {
		$metaData = aioseo()->meta->metaData->getMetaData( $this->post );

		return intval( $metaData->robots_noindex );
	}

	public function getImage( $type, $imageSource, $post ) {
		$this->thumbnailSize = apply_filters( 'aioseo_thumbnail_size', 'fullsize' );

		switch ( $imageSource ) {
			case 'featured':
				$images[ $type ] = $this->image->getFeaturedImage( $post );
				$image           = $images[ $type ];
				break;
			case 'attach':
				$images[ $type ] = $this->image->getFirstAttachedImage( $post );
				$image           = $images[ $type ];
				break;
			case 'content':
				$image = $this->image->getFirstImageInContent( $post );
				break;
			case 'author':
				$image = $this->image->getAuthorAvatar( $post );
				break;
			case 'auto':
				$image = $this->image->getFirstAvailableImage( $post, $type );
				break;
			case 'custom':
				$image = $this->image->getCustomFieldImage( $post, $type );
				break;
			case 'custom_image':
				$metaData = aioseo()->meta->metaData->getMetaData( $post );
				if ( empty( $metaData ) ) {
					break;
				}
				$image = ( 'facebook' === lcfirst( $type ) ) ? $metaData->og_image_custom_url : $metaData->twitter_image_custom_url;
				break;
			case 'default':
			default:
				$image = aioseo()->options->social->$type->general->defaultImagePosts;
		}

		if ( empty( $image ) ) {
			$image = aioseo()->options->social->$type->general->defaultImagePosts;
		}

		if ( is_array( $image ) ) {
			$images[ $type ] = $image;
			return $images[ $type ];
		}

		$attachmentId    = aioseo()->helpers->attachmentUrlToPostId( aioseo()->helpers->removeImageDimensions( $image ) );
		$images[ $type ] = $attachmentId ? wp_get_attachment_image_src( $attachmentId, $this->image->thumbnailSize ) : $image;
		return $images[ $type ];
	}

	public function is_activated() {
		return defined( 'AIOSEO_VERSION' );
	}
}
