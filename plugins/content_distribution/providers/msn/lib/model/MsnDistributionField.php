<?php
/**
 * @package plugins.msnDistribution
 * @subpackage model.enum
 */ 
interface MsnDistributionField extends BaseEnum
{
	const PROVIDER_ID = 'PROVIDER_ID';
	const CSID = 'CSID';
	const SOURCE = 'SOURCE';
	const SOURCE_FRIENDLY_NAME = 'SOURCE_FRIENDLY_NAME';
	const PAGE_GROUP = 'PAGE_GROUP';
	const TITLE = 'TITLE';
	const DESCRIPTION = 'DESCRIPTION';
	const START_DATE = 'START_DATE';
	const ACTIVATE_END_DATE = 'ACTIVATE_END_DATE';
	const SEARCHABLE_END_DATE = 'SEARCHABLE_END_DATE';
	const ARCHIVE_END_DATE = 'ARCHIVE_END_DATE';
	const TAGS_PUBLIC = 'TAGS_PUBLIC';
	const TAGS_MSNVIDEO_CAT = 'TAGS_MSNVIDEO_CAT';
	const TAGS_MSNVIDEO_TOP = 'TAGS_MSNVIDEO_TOP';
	const TAGS_MSNVIDEO_TOP_CAT = 'TAGS_MSNVIDEO_TOP_CAT';
	
	// dynamic fields
	const RELATED_LINK_N_TITLE = 'RELATED_LINK_N_TITLE';
	const RELATED_LINK_N_URL = 'RELATED_LINK_N_URL';
	const TAGS_PREMIUM_N_MARKET = 'TAGS_PREMIUM_N_MARKET';
	const TAGS_PREMIUM_N_NAMESPACE = 'TAGS_PREMIUM_N_NAMESPACE';
	const TAGS_PREMIUM_N_VALUE = 'TAGS_PREMIUM_N_VALUE';
}