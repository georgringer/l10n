
// @see 1: Hide parent
TCEFORM {
    tt_content {
        l18n_parent.disabled = 1
        sys_language_uid.config.readOnly = 1

        // @todo should only be readOnly if no translation/copy exists
        CType.config.readOnly = 1
    }
    tx_news_domain_model_news {
        l10n_parent.disabled = 1
    }
}

