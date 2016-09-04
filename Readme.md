# l10n for TYPO3 8-10
 
This extensions tries to improve the language handling of the core after discussing at T3DD16.

**Important**: This 

## Changes

- 1) Fields `l10n_parent` (`l18n_parent` for tt_content) are removed via TsConfig.
- 2) Field `sys_language_uid` is set to readOnly
- 3) Structure fields are removed in translations
- 4) If a default language is changed, transfer value of structure data (like `header_layout`) are transferred to translations as well.

## Todo

- Add language mode field setting, currently no "copy mode" available.

