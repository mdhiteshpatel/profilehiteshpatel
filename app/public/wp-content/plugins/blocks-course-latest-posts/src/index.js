import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import Edit from './edit';
import save from './save';

const x = 0;

registerBlockType('blocks-course/latest-posts', {
	edit: Edit,
	save,
});
