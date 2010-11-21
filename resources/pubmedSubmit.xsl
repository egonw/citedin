<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
 xmlns:exslt="http://exslt.org/common"
 xmlns:math="http://exslt.org/math"
 xmlns:date="http://exslt.org/dates-and-times"
 xmlns:func="http://exslt.org/functions"
 xmlns:set="http://exslt.org/sets"
 xmlns:str="http://exslt.org/strings"
 xmlns:dyn="http://exslt.org/dynamic"
 xmlns:saxon="http://icl.com/saxon"
 xmlns:xalanredirect="org.apache.xalan.xslt.extensions.Redirect"
 xmlns:xt="http://www.jclark.com/xt"
 xmlns:libxslt="http://xmlsoft.org/XSLT/namespace"
 xmlns:test="http://xmlsoft.org/XSLT/"
 extension-element-prefixes="exslt math date func set str dyn saxon xalanredirect xt libxslt test"
 exclude-result-prefixes="math str">
<xsl:output omit-xml-declaration="yes" indent="no"/>
<xsl:param name="inputFile">-</xsl:param>
<xsl:template match="/">
  <xsl:call-template name="t1"/>
</xsl:template>
<xsl:template name="t1">
  <xsl:for-each select="//MedlineCitation">
    <xsl:element name="span">
      <xsl:attribute name="id">
        <xsl:value-of select="'pmidResult'"/>
      </xsl:attribute>
      <xsl:element name="a">
        <xsl:attribute name="href">
          <xsl:value-of select="'http://www.ncbi.nlm.nih.gov/pubmed/'"/>
          <xsl:value-of select="PMID"/>
        </xsl:attribute>
        <xsl:value-of select="PMID"/>
      </xsl:element>
    </xsl:element>
    <xsl:element name="span">
      <xsl:attribute name="id">
        <xsl:value-of select="'pubmedTitle'"/>
      </xsl:attribute>
      <xsl:value-of select="'&#10;'"/>
      <xsl:value-of select="Article/ArticleTitle"/>
      <xsl:value-of select="'&#10;'"/>
    </xsl:element>
    <xsl:element name="span">
      <xsl:attribute name="id">
        <xsl:value-of select="'pubmedAuthors'"/>
      </xsl:attribute>
      <xsl:value-of select="'&#10;'"/>
      <xsl:value-of select="Article/AuthorList/Author/Initials"/>
      <xsl:value-of select="' '"/>
      <xsl:value-of select="Article/AuthorList/Author/LastName"/>
      <xsl:value-of select="' et al.'"/>
      <xsl:value-of select="'&#10;'"/>
    </xsl:element>
    <xsl:element name="span">
      <xsl:attribute name="id">
        <xsl:value-of select="'pubmedJournal'"/>
      </xsl:attribute>
      <xsl:value-of select="'&#10;'"/>
      <xsl:value-of select="Article/Journal/Title"/>
      <xsl:value-of select="'&#10;'"/>
    </xsl:element>
    <xsl:element name="span">
      <xsl:attribute name="id">
        <xsl:value-of select="'pubmedYear'"/>
      </xsl:attribute>
      <xsl:value-of select="'&#10;'"/>
      <xsl:value-of select="'('"/>
      <xsl:value-of select="Article/Journal/JournalIssue/PubDate/Year"/>
      <xsl:value-of select="')'"/>
      <xsl:value-of select="'&#10;'"/>
    </xsl:element>
    <xsl:element name="span">
      <xsl:attribute name="id">
        <xsl:value-of select="'citedinSubmitPubmedForm'"/>
      </xsl:attribute>
      <xsl:value-of select="'&#10;'"/>
      <xsl:element name="form">
        <xsl:attribute name="name">
          <xsl:value-of select="'submit'"/>
          <xsl:value-of select="PMID"/>
        </xsl:attribute>
        <xsl:element name="input">
          <xsl:attribute name="type">
            <xsl:value-of select="'Submit'"/>
          </xsl:attribute>
          <xsl:attribute name="name">
            <xsl:value-of select="'CitedIn'"/>
            <xsl:value-of select="PMID"/>
          </xsl:attribute>
          <xsl:attribute name="value">
            <xsl:value-of select="'CitedIn'"/>
          </xsl:attribute>
        </xsl:element>
        <xsl:element name="input">
          <xsl:attribute name="type">
            <xsl:value-of select="'hidden'"/>
          </xsl:attribute>
          <xsl:attribute name="name">
            <xsl:value-of select="'pmid'"/>
          </xsl:attribute>
          <xsl:attribute name="value">
            <xsl:value-of select="PMID"/>
          </xsl:attribute>
        </xsl:element>
      </xsl:element>
    </xsl:element>
  </xsl:for-each>
</xsl:template>
</xsl:stylesheet>
