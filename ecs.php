<?php

declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoMultilineWhitespaceAroundDoubleArrowFixer;
use PhpCsFixer\Fixer\ArrayNotation\NormalizeIndexBraceFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\ReturnToYieldFromFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\AttributeNotation\AttributeEmptyParenthesesFixer;
use PhpCsFixer\Fixer\AttributeNotation\OrderedAttributesFixer;
use PhpCsFixer\Fixer\Basic\BracesPositionFixer;
use PhpCsFixer\Fixer\Basic\EncodingFixer;
use PhpCsFixer\Fixer\Basic\NoMultipleStatementsPerLineFixer;
use PhpCsFixer\Fixer\Basic\NoTrailingCommaInSinglelineFixer;
use PhpCsFixer\Fixer\Basic\SingleLineEmptyBodyFixer;
use PhpCsFixer\Fixer\Casing\ClassReferenceNameCasingFixer;
use PhpCsFixer\Fixer\Casing\ConstantCaseFixer;
use PhpCsFixer\Fixer\Casing\IntegerLiteralCaseFixer;
use PhpCsFixer\Fixer\Casing\LowercaseKeywordsFixer;
use PhpCsFixer\Fixer\Casing\LowercaseStaticReferenceFixer;
use PhpCsFixer\Fixer\Casing\MagicConstantCasingFixer;
use PhpCsFixer\Fixer\Casing\MagicMethodCasingFixer;
use PhpCsFixer\Fixer\Casing\NativeFunctionCasingFixer;
use PhpCsFixer\Fixer\Casing\NativeTypeDeclarationCasingFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\CastNotation\LowercaseCastFixer;
use PhpCsFixer\Fixer\CastNotation\NoShortBoolCastFixer;
use PhpCsFixer\Fixer\CastNotation\NoUnsetCastFixer;
use PhpCsFixer\Fixer\CastNotation\ShortScalarCastFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalInternalClassFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalPublicMethodForAbstractClassFixer;
use PhpCsFixer\Fixer\ClassNotation\NoNullPropertyInitializationFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedInterfacesFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedTraitsFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedTypesFixer;
use PhpCsFixer\Fixer\ClassNotation\ProtectedToPrivateFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfStaticAccessorFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleClassElementPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\ClassUsage\DateTimeImmutableFixer;
use PhpCsFixer\Fixer\Comment\CommentToPhpdocFixer;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use PhpCsFixer\Fixer\Comment\NoEmptyCommentFixer;
use PhpCsFixer\Fixer\Comment\NoTrailingWhitespaceInCommentFixer;
use PhpCsFixer\Fixer\Comment\SingleLineCommentSpacingFixer;
use PhpCsFixer\Fixer\Comment\SingleLineCommentStyleFixer;
use PhpCsFixer\Fixer\ControlStructure\ControlStructureBracesFixer;
use PhpCsFixer\Fixer\ControlStructure\ControlStructureContinuationPositionFixer;
use PhpCsFixer\Fixer\ControlStructure\ElseifFixer;
use PhpCsFixer\Fixer\ControlStructure\EmptyLoopConditionFixer;
use PhpCsFixer\Fixer\ControlStructure\IncludeFixer;
use PhpCsFixer\Fixer\ControlStructure\NoAlternativeSyntaxFixer;
use PhpCsFixer\Fixer\ControlStructure\NoBreakCommentFixer;
use PhpCsFixer\Fixer\ControlStructure\NoSuperfluousElseifFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededBracesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededControlParenthesesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUselessElseFixer;
use PhpCsFixer\Fixer\ControlStructure\SimplifiedIfReturnFixer;
use PhpCsFixer\Fixer\ControlStructure\SwitchCaseSemicolonToColonFixer;
use PhpCsFixer\Fixer\ControlStructure\SwitchCaseSpaceFixer;
use PhpCsFixer\Fixer\ControlStructure\SwitchContinueToBreakFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\CombineNestedDirnameFixer;
use PhpCsFixer\Fixer\FunctionNotation\DateTimeCreateFromFormatCallFixer;
use PhpCsFixer\Fixer\FunctionNotation\FopenFlagOrderFixer;
use PhpCsFixer\Fixer\FunctionNotation\FopenFlagsFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\ImplodeCallFixer;
use PhpCsFixer\Fixer\FunctionNotation\LambdaNotUsedImportFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoUselessSprintfFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\StaticLambdaFixer;
use PhpCsFixer\Fixer\FunctionNotation\UseArrowFunctionsFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer;
use PhpCsFixer\Fixer\Import\GroupImportFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\NoUnneededImportAliasFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Import\SingleImportPerStatementFixer;
use PhpCsFixer\Fixer\Import\SingleLineAfterImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\ClassKeywordFixer;
use PhpCsFixer\Fixer\LanguageConstruct\CombineConsecutiveIssetsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\CombineConsecutiveUnsetsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareParenthesesFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DirConstantFixer;
use PhpCsFixer\Fixer\LanguageConstruct\ExplicitIndirectVariableFixer;
use PhpCsFixer\Fixer\LanguageConstruct\FunctionToConstantFixer;
use PhpCsFixer\Fixer\LanguageConstruct\NoUnsetOnPropertyFixer;
use PhpCsFixer\Fixer\LanguageConstruct\NullableTypeDeclarationFixer;
use PhpCsFixer\Fixer\LanguageConstruct\SingleSpaceAroundConstructFixer;
use PhpCsFixer\Fixer\ListNotation\ListSyntaxFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLinesBeforeNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\CleanNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer;
use PhpCsFixer\Fixer\Naming\NoHomoglyphNamesFixer;
use PhpCsFixer\Fixer\Operator\AssignNullCoalescingToCoalesceEqualFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\Operator\LogicalOperatorsFixer;
use PhpCsFixer\Fixer\Operator\LongToShorthandOperatorFixer;
use PhpCsFixer\Fixer\Operator\NoSpaceAroundDoubleColonFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Operator\NoUselessConcatOperatorFixer;
use PhpCsFixer\Fixer\Operator\NoUselessNullsafeOperatorFixer;
use PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer;
use PhpCsFixer\Fixer\Operator\OperatorLinebreakFixer;
use PhpCsFixer\Fixer\Operator\StandardizeIncrementFixer;
use PhpCsFixer\Fixer\Operator\StandardizeNotEqualsFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\TernaryToElvisOperatorFixer;
use PhpCsFixer\Fixer\Operator\TernaryToNullCoalescingFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\AlignMultilineCommentFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocTagRenameFixer;
use PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocArrayTypeFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocInlineTagNormalizerFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocListTypeFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAliasTagFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoUselessInheritdocFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocOrderByValueFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocOrderFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocParamOrderFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocReturnSelfReferenceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocScalarFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSeparationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSingleLineVarSpacingFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTagTypeFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimConsecutiveBlankLineSeparationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesOrderFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarAnnotationCorrectOrderFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarWithoutNameFixer;
use PhpCsFixer\Fixer\PhpTag\FullOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\NoClosingTagFixer;
use PhpCsFixer\Fixer\ReturnNotation\NoUselessReturnFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\ReturnNotation\SimplifiedNullReturnFixer;
use PhpCsFixer\Fixer\Semicolon\MultilineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Semicolon\SemicolonAfterInstructionFixer;
use PhpCsFixer\Fixer\Semicolon\SpaceAfterSemicolonFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\ExplicitStringVariableFixer;
use PhpCsFixer\Fixer\StringNotation\HeredocClosingMarkerFixer;
use PhpCsFixer\Fixer\StringNotation\HeredocToNowdocFixer;
use PhpCsFixer\Fixer\StringNotation\MultilineStringToHeredocFixer;
use PhpCsFixer\Fixer\StringNotation\NoBinaryStringFixer;
use PhpCsFixer\Fixer\StringNotation\SimpleToComplexStringVariableFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\StringNotation\StringLengthToEmptyFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBetweenImportGroupsFixer;
use PhpCsFixer\Fixer\Whitespace\HeredocIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\LineEndingFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesAroundOffsetFixer;
use PhpCsFixer\Fixer\Whitespace\NoTrailingWhitespaceFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;
use PhpCsFixer\Fixer\Whitespace\SingleBlankLineAtEofFixer;
use PhpCsFixer\Fixer\Whitespace\SpacesInsideParenthesesFixer;
use PhpCsFixer\Fixer\Whitespace\StatementIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\TypeDeclarationSpacesFixer;
use PhpCsFixer\Fixer\Whitespace\TypesSpacesFixer;
use SlevomatCodingStandard\Sniffs\Arrays\AlphabeticallySortedByKeysSniff;
use SlevomatCodingStandard\Sniffs\Arrays\MultiLineArrayEndBracketPlacementSniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassMemberSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\MethodSpacingSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;

return ECSConfig::configure()
	->withParallel()
	->withEditorConfig()
	->withPaths([
		__DIR__ . '/components/resource/src',
		__DIR__ . '/contracts',
	])
	->withConfiguredRule(
		HeaderCommentFixer::class,
		[
			'location' => 'after_declare_strict',
			'comment_type' => 'comment',
			'header' => <<<'EOF'
				This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).

				(c) Jacob Tobiasz <jacob@alphpaca.io>

				This source file is subject to the Apache License 2.0 that is bundled
				with this source code in the file LICENSE.
				EOF,
		],
	)
	->withSpacing(indentation: Option::INDENTATION_TAB)

	// Array notation
	->withRules([
		NoMultilineWhitespaceAroundDoubleArrowFixer::class,
		NoWhitespaceBeforeCommaInArrayFixer::class,
		NormalizeIndexBraceFixer::class,
		ReturnToYieldFromFixer::class,
		TrimArraySpacesFixer::class,
		WhitespaceAfterCommaInArrayFixer::class,
	])
	->withConfiguredRule(ArraySyntaxFixer::class, ['syntax' => 'short'])

	// Attribute notation
	->withRules([
		AttributeEmptyParenthesesFixer::class,
		OrderedAttributesFixer::class,
	])

	// Basic
	->withRules([
		BracesPositionFixer::class,
		EncodingFixer::class,
		NoMultipleStatementsPerLineFixer::class,
		NoTrailingCommaInSinglelineFixer::class,
		SingleLineEmptyBodyFixer::class,
	])

	// Casing
	->withRules([
		ClassReferenceNameCasingFixer::class,
		ConstantCaseFixer::class,
		IntegerLiteralCaseFixer::class,
		LowercaseKeywordsFixer::class,
		LowercaseStaticReferenceFixer::class,
		MagicConstantCasingFixer::class,
		MagicMethodCasingFixer::class,
		NativeFunctionCasingFixer::class,
		NativeTypeDeclarationCasingFixer::class,
	])

	// Cast notation
	->withRules([
		CastSpacesFixer::class,
		LowercaseCastFixer::class,
		NoShortBoolCastFixer::class,
		NoUnsetCastFixer::class,
		ShortScalarCastFixer::class,
	])

	// Class notation
	->withRules([
		ClassAttributesSeparationFixer::class,
		ClassDefinitionFixer::class,
		FinalPublicMethodForAbstractClassFixer::class,
		NoNullPropertyInitializationFixer::class,
		OrderedInterfacesFixer::class,
		OrderedTraitsFixer::class,
		OrderedTypesFixer::class,
		ProtectedToPrivateFixer::class,
		SelfAccessorFixer::class,
		SelfStaticAccessorFixer::class,
		SingleClassElementPerStatementFixer::class,
		SingleTraitInsertPerStatementFixer::class,
		VisibilityRequiredFixer::class,
	])
	->withConfiguredRule(FinalInternalClassFixer::class, ['include' => []])

	// Class usage
	->withRules([
		DateTimeImmutableFixer::class,
	])

	// Comment
	->withRules([
		CommentToPhpdocFixer::class,
		NoEmptyCommentFixer::class,
		NoTrailingWhitespaceInCommentFixer::class,
		SingleLineCommentSpacingFixer::class,
	])
	->withConfiguredRule(SingleLineCommentStyleFixer::class, ['comment_types' => ['hash']])

	// Control structure
	->withRules([
		ControlStructureBracesFixer::class,
		ControlStructureContinuationPositionFixer::class,
		ElseifFixer::class,
		EmptyLoopConditionFixer::class,
		IncludeFixer::class,
		NoAlternativeSyntaxFixer::class,
		NoBreakCommentFixer::class,
		NoSuperfluousElseifFixer::class,
		NoUnneededControlParenthesesFixer::class,
		NoUselessElseFixer::class,
		SimplifiedIfReturnFixer::class,
		SwitchCaseSemicolonToColonFixer::class,
		SwitchCaseSpaceFixer::class,
		SwitchContinueToBreakFixer::class,
		TrailingCommaInMultilineFixer::class,
	])
	->withConfiguredRule(NoUnneededBracesFixer::class, ['namespaces' => true])
	->withConfiguredRule(YodaStyleFixer::class, ['equal' => false, 'identical' => false, 'less_and_greater' => false])

	// Function notation
	->withRules([
		CombineNestedDirnameFixer::class,
		DateTimeCreateFromFormatCallFixer::class,
		FopenFlagOrderFixer::class,
		FopenFlagsFixer::class,
		FunctionDeclarationFixer::class,
		ImplodeCallFixer::class,
		LambdaNotUsedImportFixer::class,
		MethodArgumentSpaceFixer::class,
		NoSpacesAfterFunctionNameFixer::class,
		NoUselessSprintfFixer::class,
		ReturnTypeDeclarationFixer::class,
		StaticLambdaFixer::class,
		UseArrowFunctionsFixer::class,
		VoidReturnFixer::class,
	])

	// Import
	->withRules([
		GlobalNamespaceImportFixer::class,
		GroupImportFixer::class,
		NoLeadingImportSlashFixer::class,
		NoUnneededImportAliasFixer::class,
		NoUnusedImportsFixer::class,
		OrderedImportsFixer::class,
		SingleLineAfterImportsFixer::class,
	])
	->withConfiguredRule(FullyQualifiedStrictTypesFixer::class, ['import_symbols' => true])
	->withConfiguredRule(SingleImportPerStatementFixer::class, ['group_to_single_imports' => false])

	// Language construct
	->withRules([
		ClassKeywordFixer::class,
		CombineConsecutiveIssetsFixer::class,
		CombineConsecutiveUnsetsFixer::class,
		DeclareParenthesesFixer::class,
		DirConstantFixer::class,
		ExplicitIndirectVariableFixer::class,
		FunctionToConstantFixer::class,
		NoUnsetOnPropertyFixer::class,
		SingleSpaceAroundConstructFixer::class,
	])
	->withConfiguredRule(NullableTypeDeclarationFixer::class, ['syntax' => 'union'])

	// List notation
	->withRules([
		ListSyntaxFixer::class,
	])

	// Namespace notation
	->withRules([
		BlankLineAfterNamespaceFixer::class,
		BlankLinesBeforeNamespaceFixer::class,
		CleanNamespaceFixer::class,
		NoLeadingNamespaceWhitespaceFixer::class,
	])

	// Naming
	->withRules([
		NoHomoglyphNamesFixer::class,
	])

	// Operator
	->withRules([
		AssignNullCoalescingToCoalesceEqualFixer::class,
		BinaryOperatorSpacesFixer::class,
		IncrementStyleFixer::class,
		LogicalOperatorsFixer::class,
		LongToShorthandOperatorFixer::class,
		NoSpaceAroundDoubleColonFixer::class,
		NoUselessConcatOperatorFixer::class,
		NoUselessNullsafeOperatorFixer::class,
		NotOperatorWithSuccessorSpaceFixer::class,
		ObjectOperatorWithoutWhitespaceFixer::class,
		OperatorLinebreakFixer::class,
		StandardizeIncrementFixer::class,
		StandardizeNotEqualsFixer::class,
		TernaryOperatorSpacesFixer::class,
		TernaryToElvisOperatorFixer::class,
		TernaryToNullCoalescingFixer::class,
		UnaryOperatorSpacesFixer::class,
	])
	->withConfiguredRule(ConcatSpaceFixer::class, ['spacing' => 'one'])

	// PHP Tag
	->withRules([
		FullOpeningTagFixer::class,
		NoClosingTagFixer::class,
	])

	// PHPDoc
	->withRules([
		AlignMultilineCommentFixer::class,
		NoBlankLinesAfterPhpdocFixer::class,
		NoSuperfluousElseifFixer::class,
		PhpdocAlignFixer::class,
		PhpdocArrayTypeFixer::class,
		PhpdocIndentFixer::class,
		PhpdocInlineTagNormalizerFixer::class,
		PhpdocLineSpanFixer::class,
		PhpdocListTypeFixer::class,
		PhpdocNoAliasTagFixer::class,
		PhpdocNoUselessInheritdocFixer::class,
		PhpdocOrderByValueFixer::class,
		PhpdocParamOrderFixer::class,
		PhpdocReturnSelfReferenceFixer::class,
		PhpdocScalarFixer::class,
		PhpdocSeparationFixer::class,
		PhpdocSingleLineVarSpacingFixer::class,
		PhpdocSummaryFixer::class,
		PhpdocTagTypeFixer::class,
		PhpdocTrimConsecutiveBlankLineSeparationFixer::class,
		PhpdocTrimFixer::class,
		PhpdocTypesFixer::class,
		PhpdocTypesOrderFixer::class,
		PhpdocVarAnnotationCorrectOrderFixer::class,
		PhpdocVarWithoutNameFixer::class,
	])
	->withConfiguredRule(GeneralPhpdocAnnotationRemoveFixer::class, ['annotations' => [], 'case_sensitive' => false])
	->withConfiguredRule(GeneralPhpdocTagRenameFixer::class, ['case_sensitive' => false, 'replacements' => []])
	->withConfiguredRule(PhpdocOrderFixer::class, ['order' => ['param', 'return', 'throws', 'since']])

	// Return notation
	->withRules([
		NoUselessReturnFixer::class,
		ReturnAssignmentFixer::class,
		SimplifiedNullReturnFixer::class,
	])

	// Semicolon
	->withRules([
		NoEmptyStatementFixer::class,
		NoSinglelineWhitespaceBeforeSemicolonsFixer::class,
		SemicolonAfterInstructionFixer::class,
		SpaceAfterSemicolonFixer::class,
	])
	->withConfiguredRule(MultilineWhitespaceBeforeSemicolonsFixer::class, ['strategy' => 'new_line_for_chained_calls'])

	// Strict
	->withRules([
		StrictComparisonFixer::class,
		StrictParamFixer::class,
	])

	// String notation
	->withRules([
		ExplicitStringVariableFixer::class,
		HeredocClosingMarkerFixer::class,
		HeredocToNowdocFixer::class,
		MultilineStringToHeredocFixer::class,
		NoBinaryStringFixer::class,
		SimpleToComplexStringVariableFixer::class,
		SingleQuoteFixer::class,
		StringLengthToEmptyFixer::class,
	])

	// Whitespace
	->withRules([
		ArrayIndentationFixer::class,
		BlankLineBeforeStatementFixer::class,
		BlankLineBetweenImportGroupsFixer::class,
		HeredocIndentationFixer::class,
		LineEndingFixer::class,
		MethodChainingIndentationFixer::class,
		NoExtraBlankLinesFixer::class,
		NoSpacesAroundOffsetFixer::class,
		NoTrailingWhitespaceFixer::class,
		NoWhitespaceInBlankLineFixer::class,
		SingleBlankLineAtEofFixer::class,
		SpacesInsideParenthesesFixer::class,
		StatementIndentationFixer::class,
		TypeDeclarationSpacesFixer::class,
		TypesSpacesFixer::class,
	])

	// Slevomat

	// Arrays
	->withRules([
		AlphabeticallySortedByKeysSniff::class,
		MultiLineArrayEndBracketPlacementSniff::class,
	])

	// Class
	->withConfiguredRule(ClassMemberSpacingSniff::class, ['linesCountBetweenMembers' => 1])
	->withConfiguredRule(MethodSpacingSniff::class, ['minLinesCount' => 1, 'maxLinesCount' => 1])

	// Type-hints
	->withConfiguredRule(DeclareStrictTypesSniff::class, ['declareOnFirstLine' => true, 'spacesCountAroundEqualsSign' => 0]);
